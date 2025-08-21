document.addEventListener("DOMContentLoaded", () => {
  const descriptionBox = document.getElementById("descriptionBox");
  const descriptionText = document.getElementById("descriptionText");
  const allSkillCards = document.querySelectorAll(".skill-card");
  const skillCardGrid = document.querySelector("#skillCardContainer .grid");

  let activeCard = null;

  // Function to handle showing the description
  function showDescription(card) {
    const description = card.dataset.description;
    descriptionText.textContent = description;

    // On mobile, move the box right above the clicked card
    if (window.innerWidth < 1024) {
      // lg breakpoint in Tailwind
      card.parentElement.insertBefore(descriptionBox, card);
    }

    // Use the 'visible' class which controls opacity, max-height, etc.
    descriptionBox.classList.remove("opacity-0");
    descriptionBox.classList.add("opacity-100");
    activeCard = card;
  }

  // Function to hide the description
  function hideDescription() {
    // Use the 'visible' class to trigger the hiding animation
    descriptionBox.classList.remove("opacity-100");
    descriptionBox.classList.add("opacity-0");
    activeCard = null;

    // After the fade-out animation completes, move the box back to its original position.
    // This is mainly for mobile view, to prevent the layout from having a gap.
    setTimeout(() => {
      // only move if no other card has become active in the meantime.
      if (activeCard === null) {
        skillCardGrid.parentElement.insertBefore(descriptionBox, skillCardGrid);
      }
    }, 200); // This duration should match CSS transition duration
  }

  allSkillCards.forEach((card) => {
    // --- CLICK event for Mobile ---
    card.addEventListener("click", () => {
      if (window.innerWidth < 1024) {
        if (card === activeCard) {
          hideDescription();
        } else {
          showDescription(card);
        }
      }
    });

    // --- MOUSEENTER event for Desktop ---
    card.addEventListener("mouseenter", () => {
      if (window.innerWidth >= 1024) {
        // For desktop, always ensure the box is at the top before showing
        skillCardGrid.parentElement.insertBefore(descriptionBox, skillCardGrid);
        showDescription(card);
      }
    });

    // --- MOUSELEAVE event for Desktop ---
    card.addEventListener("mouseleave", () => {
      if (window.innerWidth >= 1024) {
        hideDescription();
      }
    });
  });
});
