document.addEventListener('DOMContentLoaded', function() {
    // Header scroll effect
    const header = document.querySelector('header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // DOM Elements
    const generateBtn = document.getElementById('generate-btn');
    const sendBtn = document.getElementById('send-btn');
    const invitationForm = document.getElementById('invitation-form');
    const loader = document.getElementById('loader');
    const invitationCard = document.getElementById('invitation-card');
    const invitationContent = document.getElementById('invitation-content');

    // Generate button click handler
    generateBtn.addEventListener('click', async function() {
        if (!invitationForm.checkValidity()) {
            invitationForm.reportValidity();
            return;
        }
        
        // Reset UI
        invitationCard.style.display = 'none';
        loader.style.display = 'block';
        generateBtn.disabled = true;
        
        const formData = new FormData(invitationForm);
        const data = {
            event_type: formData.get('event_type'),
            event_details: formData.get('event_details'),
            tone: formData.get('tone')
        };

        try {
            // Fetch Gemini API key from PHP endpoint
            const apiKeyResponse = await fetch('get_api_key.php');
            const apiKeyResult = await apiKeyResponse.json();
            
            if (!apiKeyResult.success) {
                throw new Error('Failed to fetch API key');
            }
            const geminiApiKey = apiKeyResult.api_key;

            // Generate invitation using Gemini API
            const invitation = await generateInvitation(
                data.event_type, 
                data.event_details, 
                data.tone, 
                geminiApiKey
            );
            
            if (!invitation) {
                throw new Error('Failed to generate invitation');
            }

            // Display the generated invitation
            invitationContent.innerHTML = formatInvitation(invitation);
            invitationCard.classList.add('show');
            invitationCard.style.display = 'block';
            
            // Enable send button
            sendBtn.disabled = false;
            
            // Scroll to the invitation card
            setTimeout(() => {
                invitationCard.scrollIntoView({ behavior: 'smooth' });
            }, 300);
            
        } catch (error) {
            showAlert(`Error: ${error.message}`, 'error');
        } finally {
            loader.style.display = 'none';
            generateBtn.disabled = false;
        }
    });

    // Send button click handler
    sendBtn.addEventListener('click', async function() {
        if (!invitationForm.checkValidity()) {
            invitationForm.reportValidity();
            return;
        }
        
        const formData = new FormData(invitationForm);
        const data = {
            event_type: formData.get('event_type'),
            event_details: formData.get('event_details'),
            tone: formData.get('tone'),
            recipient_email: formData.get('recipient_email'),
            invitation: invitationContent.textContent
        };

        try {
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            
            // Send invitation via backend
            const sendResponse = await fetch('send_invitation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const sendResult = await sendResponse.json();
            
            if (sendResult.success) {
                showAlert('Invitation sent successfully!', 'success');
                sendBtn.innerHTML = '<i class="fas fa-check me-2"></i>Sent!';
            } else {
                showAlert(`Error: ${sendResult.error}`, 'error');
                sendBtn.disabled = false;
                sendBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Send Invitation';
            }
        } catch (error) {
            showAlert(`Error: ${error.message}`, 'error');
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Send Invitation';
        }
    });

    // Format the invitation text with line breaks and styling
    function formatInvitation(text) {
        // Replace markdown-style formatting with HTML
        let formattedText = text
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>') // bold
            .replace(/\*(.*?)\*/g, '<em>$1</em>') // italic
            .replace(/\n/g, '<br>'); // line breaks
            
        // Split into paragraphs if there are double line breaks
        formattedText = formattedText.split('<br><br>').map(para => {
            return `<p>${para}</p>`;
        }).join('');
            
        return formattedText;
    }

    // Show alert message
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.innerHTML = message;
        
        // Position the alert
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.zIndex = '2000';
        alertDiv.style.padding = '15px 25px';
        alertDiv.style.borderRadius = '8px';
        alertDiv.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
        alertDiv.style.animation = 'fadeIn 0.3s ease';
        
        if (type === 'success') {
            alertDiv.style.backgroundColor = '#d4edda';
            alertDiv.style.color = '#155724';
            alertDiv.style.border = '1px solid #c3e6cb';
        } else {
            alertDiv.style.backgroundColor = '#f8d7da';
            alertDiv.style.color = '#721c24';
            alertDiv.style.border = '1px solid #f5c6cb';
        }
        
        document.body.appendChild(alertDiv);
        
        // Remove after 5 seconds
        setTimeout(() => {
            alertDiv.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => {
                document.body.removeChild(alertDiv);
            }, 300);
        }, 5000);
    }
});

async function generateInvitation(eventType, eventDetails, tone, apiKey) {
    try {
        // Note: Replace with actual Gemini API endpoint and parameters
        const url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';
        
        const prompt = `Create a ${tone} invitation for a ${eventType} event. The invitation should be well-formatted with clear sections and appropriate line breaks. Include a creative subject line at the top. Here are the event details: ${eventDetails}. Format the invitation professionally with proper spacing between sections.`;
        
        const response = await fetch(`${url}?key=${apiKey}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                contents: [{
                    parts: [{
                        text: prompt
                    }]
                }]
            })
        });

        if (!response.ok) {
            throw new Error(`API request failed with status ${response.status}`);
        }

        const result = await response.json();
        
        // Extract the generated text from the response
        const generatedText = result.candidates?.[0]?.content?.parts?.[0]?.text || 
                            'Failed to generate invitation. Please try again.';
        
        return generatedText;
    } catch (error) {
        console.error('Error generating invitation:', error);
        throw error;
    }
}