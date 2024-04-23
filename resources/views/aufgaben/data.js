var data = {
    'produkte': [
        { name: 'Ritterburg', preis: 59.99, kategorie: 1, anzahl: 3 },
        { name: 'Gartenschlau 10m', preis: 6.50, kategorie: 2, anzahl: 5 },
        { name: 'Robomaster' ,preis: 199.99, kategorie: 1, anzahl: 2 },
        { name: 'Pool 250x400', preis: 250, kategorie: 2, anzahl: 8 },
        { name: 'Rasenmähroboter', preis: 380.95, kategorie: 2, anzahl: 4 },
        { name: 'Prinzessinnenschloss', preis: 59.99, kategorie: 1, anzahl: 5 }
    ],
    'kategorien': [
        { id: 1, name: 'Spielzeug' },
        { id: 2, name: 'Garten' }
    ]
};
let getMaxPreis=data.produkte.reduce(maxPreis);
console.log( `Max Preis => ${getMaxPreis.name}`);
function maxPreis(prev,current){
    return (prev.preis > current.preis) ? prev : current; }



let getMinPreis=data.produkte.reduce(minPreis);
console.log( `Min Preis => `, getMinPreis);
function minPreis(prev,current){if(prev.preis>current.preis) return current; else return prev;}

let getPreisSum=data.produkte.reduce(Sum,0);
function Sum(prev,current){return prev + Number(current.preis);}
console.log( `Summe Preis => ` , getPreisSum.toFixed(2));



let getGesamtWert=data.produkte.reduce(GesamtWert,0);
function GesamtWert(prev,current){return prev+Number(current.preis*current.anzahl);}
console.log( `Gesamtwert => ` , getGesamtWert.toFixed(2));


function getAnzahl(data,category)
{
    let anzahl = 0;
    for (let i = 0; i< data['produkte'].length; i++)
    {
        if(data['produkte'][i]['kategorie'] === category)
        {
            anzahl += data['produkte'][i]['anzahl'];
        }
    }
    return anzahl;
}
console.log(`Anzahl Spielzeuge =>`, getAnzahl(data,1));
console.log(`Anzahl Garten =>`, getAnzahl(data,2));


