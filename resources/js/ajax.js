$('.js-generate-button').on('click', (e) => {
    
    const rangeMin = $('input[name="range_min"]').val();
    const rangeMax = $('input[name="range_max"]').val();
    const count = $('input[name="count"]').val();
    let addValue = $('input[name="add_value"]').val();
    const prefix = $('input[name="prefix"]').val();
    const suffix = $('input[name="suffix"]').val();
    const exclusion = $('input[name="exclusion"]').val();
    
    if(addValue == '') {
        addValue = 0
    }
    $.ajax('api/generate', {
        type: 'get',
        data: {
            rangeMin,
            rangeMax,
            count,
            addValue,
            prefix,
            suffix,
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
            if(addValue !== 0) {
                $('.addition-area').append(
                    `<div>${addValue} + ${num} = ${(addValue - 0) + (num - 0)}</div>`
                );
            }
        })
        // $('input').val('');
    }).fail((e) => {
        console.log(e);
    })
})