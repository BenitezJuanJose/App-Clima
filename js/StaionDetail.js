const estacion = window.location.href.split('=')[1];

loadDataStation()
    .then(data=>{data.forEach(info => {showStation(info)})}); 

function showStation(data){
    console.log(data);
    const template = tpl__station.content;
    const estacion = template.cloneNode(true);

    estacion.querySelector('.Station-title').textContent=data.apodo;
    estacion.querySelector('.Station-temperature').textContent=data.temperatura;
    estacion.querySelector('.Station-temperature-bg').style.backgroundImage=changeBackground(data.fechaActual);

    estacion.querySelector('.Station-icon-climate').style.backgroundImage=changeIcon(data.humedad);
    estacion.querySelector('.Station-detal-temp').textContent=data.temperatura;
    estacion.querySelector('.Station-detal-hum').textContent=data.humedad;
    estacion.querySelector('.Station-detal-vien').textContent=data.viento;
    console.log(changeBackground(data.fechaActual))

    Root.appendChild(estacion);
    
}

async function loadDataStation(){
    const response= await fetch(`../api/estaciones/dataStation/${estacion}`);
    let data = await response.json();   

    return data;
}

function changeBackground(data){
    if(parseInt(data)>6 && parseInt(data)<12){
       return  'url(../multimedia/background/mañana.jpg)';
    }else if(parseInt(data)>12 && parseInt(data)<19){
        return   'url(../multimedia/background/tarde.jpg)';
    }else {
        return  'url(../multimedia/background/noche.jpg)';
    }
}
function changeIcon(data){
    if(parseInt(data)>15){
       return  'url(../multimedia/icons/lluvia.gif)';
    }else {
        return   'url(../multimedia/icons/sol.gif)';
    }
}

