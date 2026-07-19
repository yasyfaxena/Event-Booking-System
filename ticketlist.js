function searchTicket() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.querySelector('.search');
    filter = input.value.toLowerCase();
    table = document.querySelector('table');
    tr = table.getElementsByTagName('tr');

    for (i = 1; i < tr.length; i++) { // Mulai dari 1 untuk melewatkan header
        tr[i].style.display = 'none'; // Sembunyikan baris secara default

        td = tr[i].getElementsByTagName('td');
        if (td.length > 0) {
            var idTicket = td[1].textContent || td[1].innerText;
            var name = td[3].textContent || td[3].innerText;
            if (idTicket.toLowerCase().indexOf(filter) > -1 || name.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
            }
        }
    }    
}

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
                        document.getElementsByName('total_bayar')[0].value = data.price;
                    })
                    .catch(error => console.error('Error fetching ticket price:', error));
            }
        });
    });
});
