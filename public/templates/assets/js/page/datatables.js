'use strict';

const DataTable = (function () {
    function example1() {
        $('#example').DataTable();
    }
    function example2() {
        $('#example2').DataTable({
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
            example2();
        },
    };
})();
