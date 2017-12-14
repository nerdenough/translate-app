const translate = phrase => $.get(`app.php?phrase=${phrase}`)

const onTextChange = async () => {
  const phrase = $('#phrase').val()
  const res = await translate(phrase)

  if (!res.length) {
    return $('#suggestions').html('Suggestions will be filtered as you type into the English phrase box above.')
  }

  const data = JSON.parse(res)
  if (!data.length) {
    return $('#suggestions').html('No suggestions to show')
  }

  const html = data.map(d => `<li>${d.phrase}: ${d.translation}</li>`).join('');
  return $('#suggestions').html(html)
}

$('#phrase').keyup(onTextChange)
