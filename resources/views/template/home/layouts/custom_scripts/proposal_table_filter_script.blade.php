<script>
    let currentSortColumn = null;
    let isAscending = true;

    function sortTable(column) {
        const table = document.getElementById("table");
        const tbody = table.getElementsByTagName("tbody")[0];
        const rows = Array.from(tbody.getElementsByTagName("tr"));

        // Toggle sorting order
        if (currentSortColumn === column) {
            isAscending = !isAscending;
        } else {
            currentSortColumn = column;
            isAscending = true;
        }

        // Determine column index based on the column name
        let columnIndex;
        switch (column) {
            case 'submissionDate':
                columnIndex = 1;
                break;
            case 'studentID':
                columnIndex = 2;
                break;
            case 'studentName':
                columnIndex = 3;
                break;
            case 'batch':
                columnIndex = 4;
                break;
            case 'cgpa':
                columnIndex = 5;
                break;
            case 'area':
                columnIndex = 6;
                break;
            case 'title':
                columnIndex = 7;
                break;
            case 'status':
                columnIndex = 8;
                break;
            case 'supervisor':
                columnIndex = 9;
                break;
            case 'supervisorInitial':
                columnIndex = 10;
                break;
                // Add cases for other columns if needed
        }

        // Sort rows
        rows.sort((rowA, rowB) => {
            const cellA = rowA.getElementsByTagName("td")[columnIndex].textContent.trim();
            const cellB = rowB.getElementsByTagName("td")[columnIndex].textContent.trim();

            // Numeric sorting for CGPA and similar fields
            if (column === 'cgpa' || column === 'batch') {
                return isAscending ? cellA - cellB : cellB - cellA;
            }
            // Date sorting for submissionDate
            else if (column === 'submissionDate') {
                const dateA = new Date(cellA);
                const dateB = new Date(cellB);
                return isAscending ? dateA - dateB : dateB - dateA;
            }
            // Alphabetical sorting for text fields
            else {
                return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
            }
        });

        // Reorder rows in the table body
        rows.forEach(row => tbody.appendChild(row));
    }
</script>