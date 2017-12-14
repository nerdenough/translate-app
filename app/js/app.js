const translate = async text => {
  // TODO: Call api
  return text
}

const onTextChange = async () => {
  const text = $('#phrase').val();
  const translated = await translate(text);
  $('#translation').text(translated);
}

$('#phrase').keyup(onTextChange)
