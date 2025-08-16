/**
 * @function updateDescriptionPanel
 * @description Inserts text into the description panel.
 * @param {string} text - The long text content to display.
 */
function updateDescriptionPanel(text) {
    const descriptionElement = document.getElementById('descriptionText');
    if (descriptionElement) {
        descriptionElement.innerHTML = text;
    }
}

// Example usage on page load
window.onload = function() {
    const myLongDescription = `
        This is a dynamically loaded description. You can paste your entire body of text here. 
        It will automatically fill the panel and become scrollable. The page scroll will not 
        activate until this section's content is fully visible.
        <br><br>
        This is useful for detailed descriptions, "About Us" sections, or product features
        that require a lot of space without cluttering the main page layout.
        <br><br>
        ... and so on.
    `;

    updateDescriptionPanel(myLongDescription);
};