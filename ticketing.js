// Function to show alert based on URL parameter
function showAlertFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if (status === 'success') {
        alert('Ticket has been booked successfully.');
    } else if (status === 'error') {
        alert('There was an error booking the ticket.');
    }
}

window.onload = showAlertFromUrl;

document.addEventListener("DOMContentLoaded", function () {
    const ticketForm = document.getElementById("ticketing-form");
    const ticketTypes = document.querySelectorAll('input[name="jenis_tiket"]');
    const totalBayarBox = document.getElementById("total_bayar_box");

    ticketTypes.forEach((ticketType) => {
        ticketType.addEventListener("change", function () {
            const idEvent = document.getElementById("id_event").value;
            const selectedTicketType = this.value;
            if (idEvent && selectedTicketType) {
                fetch(`get_ticket_price.php?id_event=${idEvent}&ticket_type=${selectedTicketType}`)
                    .then(response => response.json())
                    .then(data => {
                        totalBayarBox.innerText = data.price;
                        totalBayarInput.value = data.price;
                    })
                    .catch(error => console.error('Error fetching ticket price:', error));
            }
        });
    });
});
