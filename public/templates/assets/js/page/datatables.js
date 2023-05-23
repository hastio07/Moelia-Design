'use strict';

const DataTable = (function () {
    function example1() {
        $('#example').DataTable();
    }
    function tableAdmins() {
        $('#table-admins').DataTable({
            responsive: true,
            // lengthMenu: [
            //     [4, 10, 15, 50],
            //     [4, 10, 15, 50],
            // ],
        });
    }
    return {
        init: function () {
            example1();
            tableAdmins();
        },
    };
})();
