function newBlock(xposition, xbefore, xafter, xcolor, xtitle, xsubtitle, xcontent, xismain, xisimage) {
  return bloque = {
      position: xposition,
      before: xbefore,
      after: xafter,
      color: xcolor,
      title: xtitle,
      subtitle: xsubtitle,
      content: xcontent,
      ismain: xismain,
      isimage: xisimage,
      getTitle: function() { return this.title; },
      getContent: function() { return this.content; }
  };
}

function createBlocks(item, index) {
  var container = document.getElementsByTagName("BODY")[0];
  var tmpobj = document.createElement("DIV");
  tmpobj.id = 'bloque_' + index;
  tmpobj.classList.add('theblock');
  if (item.ismain) { tmpobj.classList.add('keyblock'); } else { tmpobj.classList.add('oneblock'); }
  //tmpobj.addEventListener( "click", function() { changeBox(tmpobj); } );
  tmpobj.style.zIndex = ((item.ismain)?'10':'0');
  tmpobj.style.background = 'radial-gradient(circle, ' + item.color + ', #000)';
  tmpobj.dataset.position = item.position;
  tmpobj.dataset.before = item.before;
  tmpobj.dataset.after = item.after;
  tmpobj.dataset.color = item.color;
  tmpobj.innerHTML = '<div class="theman '+((item.ismain)?'mainman':'boxman')+'"'+
      ((item.isimage)?' style="background-image: url(images/blockImage'+item.position+'.png);"':'') + '>'+
      '<h1 class="'+((item.ismain)?'maintitle':'boxtitle')+'">'+item.title+'</h1>'+
      '<h6 class="'+((item.ismain)?'mainsubtitle':'boxsubtitle')+'">'+item.subtitle+'</h6>'+
      '<div class="boxcontent">'+item.content+'</div>'+
      '</div>'+ 
      ((tmpobj.dataset.before>=0)?'<button class="navButton prevButton" onClick="prevButton(this.parentElement)">back</button>':'')+
      ((tmpobj.dataset.after>=0)?'<button class="navButton nextButton" onClick="nextButton(this.parentElement)">next</button>':'');
  container.appendChild(tmpobj);
  if (item.ismain) { activeBlock = tmpobj; }
  // navmenu
  var tmpitm = document.createElement("LI");
  tmpitm.classList.add('mainnavbaritem');
  tmpitm.addEventListener( "click", function() { changeBox(document.getElementById(tmpobj.id)); } );
  tmpitm.innerHTML = item.title;
  document.getElementById('mainnavbar').appendChild(tmpitm);
}

function changeBox(theobj) {
  if (theobj.dataset.position!=activeBlock.dataset.position) {
    theobj.style.zIndex='5';
    theobj.style.opacity = '1';
    setTimeout( function( objnxt, theobj ) { 
      theobj.style.zIndex='10'; 
      objnxt.style.zIndex='0';  
      }, 800, activeBlock, theobj
    );
    activeBlock.style.opacity = '0';
    activeBlock = theobj; 
  }
}

function nextButton(theobj) {
  tmpnxt = document.getElementById('bloque_' + theobj.dataset.after);
  tmpnxt.style.zIndex='5';
  tmpnxt.style.opacity = '1';
  setTimeout( function( theobj, tmpnxt ) { 
      tmpnxt.style.zIndex='10'; 
      theobj.style.zIndex='0';  
      }, 800, theobj, tmpnxt
  );
  theobj.style.opacity = '0';
  activeBlock = tmpnxt; 
}

function prevButton(theobj) {
  tmpprv = document.getElementById('bloque_' + theobj.dataset.before);
  tmpprv.style.zIndex='5';
  tmpprv.style.opacity = '1';
  setTimeout( function( theobj, tmpprv ) { 
      tmpprv.style.zIndex='10'; 
      theobj.style.zIndex='0';  
      }, 800, theobj, tmpprv
  );
  theobj.style.opacity = '0';
  activeBlock = tmpprv; 
}
