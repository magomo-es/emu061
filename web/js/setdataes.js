var activeBlock;
var blockAry = [];
blockAry.push( newBlock( 0, -1, 1, '#1162ac', 'EMU061', 'Emulador de Emergencias 061', '', true, false ) );
blockAry.push( newBlock( 1, 0, 2, '#db6708', 'Proyecto', 'Proyecto de emulador de Emergencias 061 para INS Broggi', 
    '<p>"En INS Moisès Broggi ens demana crear una eina que ajudi en la formació dels estudiants Cicle d’Emergències Sanitàries. Concretament vol que fem un simulador formatiu per gestionar les  demandes d’assistència d’urgència i emergència sanitària extrahospitalària a Catalunya. El simulador ha de permetre gestionar les trucades d’emergència a la vegada que ens ensenya a fer-ho de manera correcta."</p>'+
    '<p>Este breve párrafo extraído de su presentación nos plantea el desafío que afrontamos como último proyecto de cierre del ciclo DAW 2021 que, a pesar de las circunstancias, encaramos con entusiasmo como un equipo de compañeros que ha compartido los ultimos 3 años de formación.</p>', 
    false, true ) );
blockAry.push( newBlock( 2, 1, 3, '#D9D608', 'Documentación', 'Soporte documental del Proyecto EMU061', 
    '<ul><li><a href="https://github.com/magomo-es/emu061/blob/master/Documents/Grupo_PBLCanvas.pdf" target="_blank">Canvas</a></li>'+
    '<li><a href="https://github.com/magomo-es/emu061/blob/master/Documents/Proyecto_Wireframes.pdf" target="_blank">Wireframes</a></li>'+
    '<li><a href="https://github.com/magomo-es/emu061/blob/master/Documents/Proyecto_Mockups.pdf" target="_blank">Mockups</a></li>'+
    '<li><a href="https://github.com/magomo-es/emu061/blob/master/Documents/Proyecto_Casos_de_Uso.pdf" target="_blank">Casos de Uso</a></li>'+
    '<li><a href="https://github.com/magomo-es/emu061/blob/master/Documents/Proyecto_Paleta_de_Colores.pdf" target="_blank">Paleta de Colores</a></li>'+
    '<li><a href="https://github.com/magomo-es/emu061/blob/master/Documents/Proyecto_Modelo_BBDD.pdf" target="_blank">Esquema Tablas (DDBB)</a></li>'+
    '<li><a href="https://github.com/magomo-es/emu061/blob/master/Documents/Proyecto_Descripcion.pdf" target="_blank">Presentacion</a></li></ul>', 
    false, true ) );
blockAry.push( newBlock( 3, 2, 4, '#D90808', 'Equipo', '\"DAM2T Survivors\"', 
    '<ul><li><a href="https://gallardoibarrarodo.wixsite.com/rufuus06" target="_blank">Rodolfo Gallardo</a></li>'+
    '<li><a href="https://mdelatorreochoa.wixsite.com/misitio" target="_blank">Mario de la Torre</a></li>'+
    '<li><a href="http://magomo.es" target="_blank">Marcelo Goncevatt</a></li></ul>', 
    false, true ) );
blockAry.push( newBlock( 4, 3, -1, '#078827', 'Contáctanos', 'Para más info, contratos y expediciones', 'hello@emu061.es', 
    false, true ) );
blockAry.forEach( createBlocks );
