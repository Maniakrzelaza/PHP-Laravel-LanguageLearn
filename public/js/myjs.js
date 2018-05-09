$(document).ready(function () {

    $(".expand-table-header").click(function () {
        var ii = $(this).attr('id');
        console.log(ii);
        $('.' + ii).toggle();
    });

    $(".expand-subtable").click(function () {
        var id=$(this).attr('id');
        console.log(id);
        $('.' + id).toggle();
    });
    $("#showBtn1").click(function () {
         $('.pokaZestaw').toggle();
    });
    $("#showAlg1Btn1").click(function () {
        $('.alg1').toggle();
    });

    $("#showAlg2Btn1").click(function () {
        $('.alg2').toggle();
    });
    $("#showAlg3Btn1").click(function () {
        $('.alg31').toggle();
    });

    $("#showBtn2").click(function () {
        $('.pokaZestaw2').toggle();
    });
    $("#showAlg1Btn2").click(function () {
        $('.alg12').toggle();
    });

    $("#showAlg2Btn2").click(function () {
        $('.alg22').toggle();
    });
    $("#showAlg3Btn2").click(function () {
        $('.alg32').toggle();
    });

    $("#setLang1").click(function () {
        $('.lang1').toggle();
        $('#setLang2').toggle();
        $('#setLang1').toggle();
    })
    $("#setLang2").click(function () {
        $('.lang2').toggle();
        $('#setLang1').toggle();
        $('#setLang2').toggle();
    })
});
