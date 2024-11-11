<script>
    function filterByBatch() {
        const selectedBatch = document.getElementById("batchFilter").value;
        const table = document.getElementById("table");
        const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        Array.from(rows).forEach(row => {
            const batchCell = row.getElementsByTagName("td")[4]; // Assuming batch is in the 5th column (index 4)
            const batchValue = batchCell.textContent.trim();

            if (selectedBatch === "all" || batchValue === selectedBatch) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>