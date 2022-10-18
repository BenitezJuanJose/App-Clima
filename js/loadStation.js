loadStation().then(stations=>{
    stations.forEach(station=> {
        showStation(station);
    });
})

function showStation(data){
    const template= tpl_Station.content;
    const card= template.cloneNode(true);



    card.querySelector('.Station-btn').setAttribute('href',`./view/estacion.html?estacion=${data.chipid}`)    
    card.querySelector('.Station-title').textContent=data.apodo;
    card.querySelector('.Station-location').textContent=data.ubicacion;
    card.querySelector('.Station-view').textContent=data.vistas;
    card.querySelector('.Station-bg').style.backgroundImage=changeBackground(data.fechaActual);
    card.querySelector('.Station-icon-climate').style.backgroundImage=changeIcon(data.humedad)
    
    StationContainer.appendChild(card);
}

async function loadStation(){
    const response= await fetch('api/estaciones/list');
    const data= await response.json();

    return data;
}

function changeBackground(data){
    if(parseInt(data)>6 && parseInt(data)<12){
       return 'url(multimedia/background/mañana.jpg)';
    }else if(parseInt(data)>12 && parseInt(data)<19){
        return  'url(multimedia/background/tarde.jpg)';
    }else {
        return  'url(multimedia/background/noche.jpg)';
    }
}

function changeIcon(data){
    if(parseInt(data)>15){
       return  'url(multimedia/icons/lluvia.gif)';
    }else {
        return   'url(multimedia/icons/sol.gif)';
    }
}


