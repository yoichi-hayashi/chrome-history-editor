$('.js-generate-button').on('click', (e) => {
    
    const minNum = $('input[name="min_num"]').val();
    const maxNum = $('input[name="max_num"]').val();
    const count = $('input[name="count"]').val();
    let sumNum = $('input[name="sum_num"]').val();
    const forwardStationary = $('input[name="forward_stationary"]').val();
    const backwardStationary = $('input[name="backward_stationary"]').val();
    const exclusion = $('input[name="exclusion"]').val();
    
    if(sumNum == '') {
        sumNum = 0
    }
    $.ajax('api/generate', {
        type: 'get',
        data: {
            minNum,
            maxNum,
            count,
            sumNum,
            forwardStationary,
            backwardStationary,
            exclusion
        },
        dataType: 'json'
    })
    .done((data) => {
        $('.output-area').html('');
        $('.addition-area').html('');
        $.each(data, function(i, num) {
            $('.output-area').append(
                `<div>${num}</div>`
            );
            if(sumNum !== 0) {
                $('.addition-area').append(
                    `<div>${sumNum} + ${num} = ${(sumNum - 0) + (num - 0)}</div>`
                );
            }
        })
        // $('input').val('');
    }).fail((e) => {
        console.log(e);
    })
})