$('.js-generate-button').on('click', (e) => {

  const fromValue = $('select[name="from"]').val();
  const delId = $('input[name="del_id"]').val();
  const fromBetween = $('select[name="from_between"]').val();
  const delIdMin = $('input[name="del_id_min"]').val();
  const delIdMax = $('input[name="del_id_max"]').val();
  const fromVisit = $('input[name="from_visit"]').val();
  const fromVisitId = $('input[name="from_visit_id"]').val();
  const fromVisitBetween = $('input[name="from_visit_between"]').val();
  const fromVisitMin = $('input[name="from_visit_min"]').val();
  const fromVisitMax = $('input[name="from_visit_max"]').val();
  const visitTime = $('input[name="visit_time"]').val();
  const visitsId = $('input[name="visits_id"]').val();
  const lastVisitTime = $('input[name="last_visit_time"]').val();
  const urlsId = $('input[name="urls_id"]').val();
  const fromTime = $('input[name="from_time"]').val();
  const untilTime = $('input[name="until_time"]').val();
  const visitDurationId = $('input[name="visit_duration_id"]').val();
  const sequenceFix = $('input[name="sequence_fix"]').val();
  const sequenceName = $('select[name="sequence_name"]').val();
  
  let sql01 = `DELETE FROM ${fromValue} WHERE id = ${delId};`;
  let sql02 = `DELETE FROM ${fromBetween} WHERE id BETWEEN ${delIdMin} AND ${delIdMax};`;
  let sql03 = `UPDATE visits SET from_visit = ${fromVisit} WHERE id = ${fromVisitId};`;
  let sql04 = `UPDATE visits SET from_visit = ${fromVisitBetween} WHERE id BETWEEN ${fromVisitMin} AND ${fromVisitMax};`;
  let sql05 = `UPDATE visits SET visit_time = ${visitTime} WHERE id = ${visitsId};`;
  let sql06 = `UPDATE visits SET last_visit_time = ${lastVisitTime} WHERE id = ${urlsId};`;
  let sql07 = `UPDATE visits SET visit_duration = ${untilTime} - ${fromTime} WHERE id = ${visitDurationId};`;
  let sql08 = `UPDATE sqlite_sequence SET seq = seq - ${sequenceFix} WHERE name = ${sequenceName};`;
  
  if(delId !== "") {
    if(fromValue === "visits") {
      $('.js-output-area').append(
        `<div>
          <input type="checkbox" id="visits_delete_value-${delId}">
          <label for="visits_delete_value-${delId}">${sql01}</label>
        </div>`
      )
    } else {
      $('.js-output-area').append(
        `<div>
          <input type="checkbox" id="urls_delete_value-${delId}">
          <label for="urls_delete_value-${delId}">${sql01}</label>
        </div>`
      )
    }
  }
  
  if(delIdMin !== "" && delIdMax !== "") {
    if(fromBetween === "visits") {
      $('.js-output-area').append(
        `<div>
          <input type="checkbox" id="visits_delete_value-${delIdMin}_${delIdMax}">
          <label for="visits_delete_value-${delIdMin}_${delIdMax}">${sql02}</label>
        </div>`
      )
    } else {
      $('.js-output-area').append(
        `<div>
          <input type="checkbox" id="urls_delete_value-${delIdMin}_${delIdMax}">
          <label for="urls_delete_value-${delIdMin}_${delIdMax}">${sql02}</label>
        </div>`
      )
    }
  } else if((delIdMin === "" && delIdMax !== "") || (delIdMin !== "" && delIdMax === "")) {
    alert("レコード削除の項目が片方しか入力されていません")
  }

  if(fromVisit !== "" && fromVisitId !== "") {
    $('.js-output-area').append(
      `<div>
        <input type="checkbox" id="from_visit_value-${fromVisitId}">
        <label for="from_visit_value-${fromVisitId}">${sql03}</label>
      </div>`
    )
  } else if((fromVisit === "" && fromVisitId !== "") || (fromVisit !== "" && fromVisitId === "")) {
    alert("ページ遷移元修正の項目が片方しか入力されていません")
  }
  
  if(fromVisitBetween !== "" && fromVisitMin !== "" && fromVisitMax !== "") {
    $('.js-output-area').append(
      `<div>
        <input type="checkbox" id="from_visit_value-${fromVisitMin}_${fromVisitMax}">
        <label for="from_visit_value-${fromVisitMin}_${fromVisitMax}">${sql04}</label>
      </div>`      
    )
  } else if(
    (fromVisitBetween !== "" && fromVisitMin === "" && fromVisitMax === "")
    || (fromVisitBetween === "" && fromVisitMin !== "" && fromVisitMax === "")
    || (fromVisitBetween === "" && fromVisitMin === "" && fromVisitMax !== "")
    || (fromVisitBetween !== "" && fromVisitMin !== "" && fromVisitMax === "")
    || (fromVisitBetween !== "" && fromVisitMin === "" && fromVisitMax !== "")
    || (fromVisitBetween === "" && fromVisitMin !== "" && fromVisitMax !== "")
    ) {
      alert("ページ遷移元修正の項目のいずれかが不足しています")
    }
  
  if(visitTime !== "" && visitsId !== "") {
    $('.js-output-area').append(
      `<div>
        <input type="checkbox" id="visit_time_value-${visitsId}">
        <label for="visit_time_value-${visitsId}">${sql05}</label>
      </div>`
    )
  } else if((visitTime === "" && visitsId !== "") || (visitTime !== "" && visitsId === "")) {
    alert("visitsテーブルの閲覧時刻修正の項目が片方しか入力されていません")
  }
  
  if(lastVisitTime !== "" && urlsId !== "") {
    $('.js-output-area').append(
      `<div>
        <input type="checkbox" id="last_visit_time_value-${urlsId}">
        <label for="last_visit_time_value-${urlsId}">${sql06}</label>
      </div>`
    )
  } else if((lastVisitTime === "" && urlsId !== "") || (lastVisitTime !== "" && urlsId === "")) {
    alert("urlsテーブルの閲覧時刻修正の項目が片方しか入力されていません")
  }
  
  if(untilTime !== "" && fromTime !== "" && visitDurationId !== "") {
    $('.js-output-area').append(
      `<div>
        <input type="checkbox" id="duration_value-${visitDurationId}">
        <label for="duration_value-${visitDurationId}">${sql07}</label>
      </div>`
    )
  } else if(
    (untilTime !== "" && fromTime === "" && visitDurationId === "")
    || (untilTime === "" && fromTime !== "" && visitDurationId === "")
    || (untilTime === "" && fromTime === "" && visitDurationId !== "")
    || (untilTime !== "" && fromTime !== "" && visitDurationId === "")
    || (untilTime !== "" && fromTime === "" && visitDurationId !== "")
    || (untilTime === "" && fromTime !== "" && visitDurationId !== "")
    ) {
      alert("ページ滞在時間修正の項目のいずれかが不足しています")
    }
  
  if(sequenceFix !== "") {
    $('.js-output-area').append(
      `<div>
        <input type="checkbox" id="sqlite_sequence_value-${sequenceFix}">
        <label for="sqlite_sequence_value-${sequenceFix}">${sql08}</label>
      </div>`
    )
  }
  
  if(
    delId === ""
    && delIdMin === ""
    && delIdMax === ""
    && fromVisit === ""
    && fromVisitId === ""
    && fromVisitBetween == ""
    && fromVisitMin == ""
    && fromVisitMax == ""
    && visitTime === ""
    && visitsId === ""
    && lastVisitTime === ""
    && urlsId === ""
    && untilTime === ""
    && fromTime === ""
    && visitDurationId === ""
    && sequenceFix === ""
  ) {
    alert("すべての入力欄が空です")
  }
  
  if(
    delId !== "" 
    || (delIdMin !== "" && delIdMax !== "")
    || (fromVisit !== "" && fromVisitId !== "")
    || (fromVisitBetween !== "" && fromVisitMin !== "" && fromVisitMax !== "")
    || (visitTime !== "" && visitsId !== "")
    || (lastVisitTime !== "" && urlsId !== "")
    || (untilTime !== "" && fromTime !== "" && visitDurationId !== "")
    || sequenceFix !== ""
  ) {
    $('.js-output-area').show().addClass('border border-secondary pr-3');
  }
  
  $('input').val('');
});

$('.js-add-button').on('click', (e) => {
  $('.js-output-area').append(
    `<div>
      <input type="checkbox" id="sqlite_sequence">
      <label for="sqlite_sequence">SELECT * FROM sqlite_sequence;</label>
    </div>`
  )
  $('.js-output-area').show().addClass('border border-secondary pr-3');
});

$('.js-delete-button').on('click', (e) => {
  
  $('input[type="checkbox"]:checked').parent().remove();
  
  const el = $('.js-output-area');
  const children = el.children('div');
  
  if(children.length === 0) {
    el.hide();
  }
});

$('.js-export-button').on('click', (e) => {
  
  const sqlArr = $('.js-output-area').find('label');
  let sqlQuery = sqlArr.map(function() {
    return $(this).text() + '\n';
  }).get().join('');
  
  downloadText("downloadsql.txt", sqlQuery);
})

function downloadText(fileName, text) {
  const blob = new Blob([text], { type: 'text/plain' });
  const aTag = document.createElement('a');
  aTag.href = URL.createObjectURL(blob);
  aTag.target = '_blank';
  aTag.download = fileName;
  aTag.click();
  URL.revokeObjectURL(aTag.href);
}