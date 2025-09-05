// --- Custom Language Switcher Logic ---
function setupLangSwitcher(type) { // type is 'desktop' or 'mobile'
    const container = document.getElementById(`lang-switcher-container-${type}`);
    if (!container) return;

    const button = container.querySelector('.lang-switcher-button');
    const menu = container.querySelector('.lang-switcher-menu');
    const options = container.querySelectorAll('.lang-switcher-option');
    const selectedFlag = document.getElementById(`selected-lang-flag-${type}`);
    const selectedText = document.getElementById(`selected-lang-text-${type}`);
    const hiddenSelect = document.getElementById(`language-switcher-${type}`);
    
    const optionDetails = {
        my: { text: 'မြန်မာ', flag: 'https://flagcdn.com/w20/mm.png' },
        en: { text: 'English', flag: 'https://flagcdn.com/w20/gb.png' }
    };

    // Function to update the button's appearance
    function updateButton(lang) {
        if (optionDetails[lang]) {
            selectedFlag.src = optionDetails[lang].flag;
            selectedText.textContent = optionDetails[lang].text;
        }
    }

    // Toggle menu visibility
    button.addEventListener('click', (e) => {
        e.stopPropagation();
        // Close other switcher if open
        const otherType = type === 'desktop' ? 'mobile' : 'desktop';
        const otherMenu = document.querySelector(`#lang-switcher-container-${otherType} .lang-switcher-menu`);
        if (otherMenu) otherMenu.classList.add('hidden');

        menu.classList.toggle('hidden');
    });

    // Handle option selection
    options.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            const lang = option.getAttribute('data-lang');
            
            // Update the hidden select and trigger its change event
            hiddenSelect.value = lang;
            hiddenSelect.dispatchEvent(new Event('change'));
            
            // Close menu
            menu.classList.add('hidden');
        });
    });

    // Listen to the original select's changes to update the custom button
    // This keeps everything in sync, even if something else changes the select's value
    hiddenSelect.addEventListener('change', () => {
        updateButton(hiddenSelect.value);
    });

    // Set initial state from the hidden select
    updateButton(hiddenSelect.value);
}

// Set up both switchers
setupLangSwitcher('desktop');
setupLangSwitcher('mobile');

// Close dropdowns when clicking outside the menu
document.addEventListener('click', () => {
    document.querySelectorAll('.lang-switcher-menu').forEach(menu => {
        menu.classList.add('hidden');
    });
});

