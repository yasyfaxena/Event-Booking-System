function searchEvent() {
    let input = document.querySelector('.search').value.toLowerCase();
    let table = document.getElementById('event-list');
    let rows = table.getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName('td');
        let match = false;
        for (let j = 1; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().includes(input)) {
                match = true;
                break;
            }
        }
        if (match) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

let currentAction = '';

function toggleActionButtons(action) {
    let actionHeader = document.getElementById('action-header');
    let actionCells = document.querySelectorAll('.action-cell');
    let editButtons = document.querySelectorAll('.edit-button');
    let deleteButtons = document.querySelectorAll('.delete-button');

    if (currentAction === action) {
        actionHeader.style.display = 'none';
        actionCells.forEach(cell => cell.style.display = 'none');
        editButtons.forEach(button => button.style.display = 'none');
        deleteButtons.forEach(button => button.style.display = 'none');
        currentAction = '';
    } else {
        actionHeader.style.display = '';
        actionCells.forEach(cell => cell.style.display = '');
        editButtons.forEach(button => button.style.display = (action === 'edit') ? '' : 'none');
        deleteButtons.forEach(button => button.style.display = (action === 'delete') ? '' : 'none');
        currentAction = action;
    }
}

function editEvent(button) {
    let row = button.closest('tr');
    let eventId = row.cells[1].innerText;
    window.location.href = `insert.html?eventId=${eventId}`;
}

function deleteEvent(button) {
    let row = button.closest('tr');
    row.parentNode.removeChild(row);
}

function showEventList() {
    document.getElementById('event-list-content').style.display = 'block';
    document.getElementById('ticket-list-content').style.display = 'none';
    toggleActionButtons(''); 
}
