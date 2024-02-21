// Sample skill suggestions
const skillSuggestions = ["HTML", "CSS", "JavaScript","Java","Laravel", "PHP", "Python", "React", "Node.js", "SQL", "Bootstrap"];

function showSuggestions() {
    const input = document.getElementById("skillsInput");
    const suggestionsContainer = document.getElementById("suggestions");

    // Clear previous suggestions
    suggestionsContainer.innerHTML = "";

    // Get input value
    const inputValue = input.value.toLowerCase();

    // Filter suggestions based on input
    const filteredSuggestions = skillSuggestions.filter(skill => skill.toLowerCase().includes(inputValue));

    // Display suggestions
    filteredSuggestions.forEach(suggestion => {
        const suggestionItem = document.createElement("div");
        suggestionItem.classList.add("suggestion-item");
        suggestionItem.textContent = suggestion;
        suggestionItem.addEventListener("click", () => addSkill(suggestion));
        suggestionsContainer.appendChild(suggestionItem);
    });

    // Show/hide suggestions container
    suggestionsContainer.style.display = filteredSuggestions.length > 0 ? "block" : "none";
}

function addSkill(skill) {
    const input = document.getElementById("skillsInput");
    input.value = ''; // Clear the input field after selecting a suggestion
    const selectedSkillsContainer = document.getElementById("selectedSkills");
    const selectedSkillItem = document.createElement("div");
    selectedSkillItem.textContent = skill;
    selectedSkillItem.addEventListener("click", function () {
        selectedSkillsContainer.removeChild(selectedSkillItem);
    });
    selectedSkillsContainer.appendChild(selectedSkillItem);
    
}


