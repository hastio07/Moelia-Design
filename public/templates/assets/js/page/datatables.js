'use strict';

const DataTable = (function () {
    function tabelPesananProses() {
        $('#tabelPesananProses').DataTable({
            responsive: true,
        });
    }
    function tabelLayanan() {
        $('#tabelLayanan').DataTable({
            responsive: true,
        });
    }
    function tabelJadwal() {
        $('#tabelJadwal').DataTable({
            responsive: true,
        });
    }
    function tableAdmins() {
        $('#table-admins').DataTable({
            responsive: true,
        });
    }
    return {
        init: function () {
            tabelPesananProses();
            tableAdmins();
            tabelJadwal();
            tabelLayanan();
        },
    };
})();
