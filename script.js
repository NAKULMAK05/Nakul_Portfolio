function redirectToContact() {
    window.location.href = "#contact";
}


document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".contact form");
    const sendMessageButton = form.querySelector("button[type='submit']");

    sendMessageButton.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default button behavior

        // Create FormData object to store form data
        const formData = new FormData(form);

        // Send form data to PHP script using AJAX
        fetch("send_email.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Email sent successfully
                alert("Thanks for contacting me!");
                form.reset(); // Reset the form
            } else {
                // Error sending email
                alert("Failed to send message. Please try again later.");
            }
        })
        .catch(error => {
            // Error sending email
            alert("Failed to send message. Please try again later.");
        });
    });
});
document.getElementById("downloadButton").addEventListener("click", function() {
    var link = document.createElement('a');
    link.href = 'Nakul Indust Resume.pdf'; 
    link.download = 'Nakul Indust Resume.pdf'; 
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
