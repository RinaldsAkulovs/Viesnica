console.log('init')

    fetch('http://html.lv/Viesnica/Viesnicas/php/data1.php',
    {
        method: 'POST',
        body: JSON.stringify('name=fhh++&email=fhfdgh&date=fhfdh&date2=dfghdfh&people_number=dfhdfh&registration=1')
    })
    .then(res => console.log(res.json()))
    .catch(err => console.error(err))
