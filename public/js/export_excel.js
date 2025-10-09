function exportToExcel() {
    const table = document.getElementById('orderTable');
    if (!table) {
        alert("Không tìm thấy bảng dữ liệu!");
        return;
    }
    const wb = XLSX.utils.table_to_book(table, { sheet: "DonHang" });
    XLSX.writeFile(wb, "don_hang.xlsx");
}
