function toggleVisibility() {
    var visibleDiv = document.getElementById('visibleSection');
    var hiddenDiv = document.getElementById('formmasterDiv');

    if (visibleDiv.style.display !== 'none') {
        visibleDiv.style.display = 'none';
        hiddenDiv.style.display = 'flex';
    } else {
        visibleDiv.style.display = 'block';
        hiddenDiv.style.display = 'none';
    }
}

function giveAlert() {
    alert("Congradulations!\nYour job has been posted.");
}

