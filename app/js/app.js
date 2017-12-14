const translate = phrase => $.get(`app.php?phrase=${phrase}`)

const onTextChange = async () => {
  const phrase = $('#phrase').val()
  const res = await translate(phrase)

  if (!res.length) {
    return $('#translation').text('')
  }

  const data = JSON.parse(res)
  const suggestions = data.map(d => `${d.phrase}: ${d.translation}`).join('\n');
  return $('#translation').text(suggestions)
}

$('#phrase').keyup(onTextChange)
