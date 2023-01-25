$( document ).ready(function() {
    for (let index = 2; index <= 15; index++) {
        //$('#add' + index).hide();        
        $('#' + index).hide();
    }
    for(let i = 1; i <=15; i++){
        $("select[name='ingredient["+ i + "]']").append("<option selected value='--'>--</option>")
    }
    $('.add1').click(function(){
        $('#2').show();
    });
    $('.add2').click(function(){
        $('#3').show();
    });
    $('.add3').click(function(){
        $('#4').show();
    });
    $('.add4').click(function(){
        $('#5').show();
    });
    $('.add5').click(function(){
        $('#6').show();
    });
    $('.add6').click(function(){
        $('#7').show();
    });
    $('.add7').click(function(){
        $('#8').show();
    });
    $('.add8').click(function(){
        $('#9').show();
    });
    $('.add9').click(function(){
        $('#10').show();
    });
    $('.add10').click(function(){
        $('#11').show();
    });
    $('.add11').click(function(){
        $('#12').show();
    });
    $('.add12').click(function(){
        $('#13').show();
    });
    $('.add13').click(function(){
        $('#14').show();
    });
    $('.add14').click(function(){
        $('#15').show();
    });
})