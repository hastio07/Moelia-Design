'use strict';

const DataTable = (function () {
    function tableAdmins() {
        $('#table-admins').DataTable({
            responsive: true,
        });
    }
    return {
        init: function () {
            tableAdmins();
        },
    };
})();
