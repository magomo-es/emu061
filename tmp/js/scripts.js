function newBlock(xposition, xbefore, xafter, xcolor, xtitle, xsubtitle, xcontent, xismain) {
  return bloque = {
      position: xposition,
      before: xbefore,
      after: xafter,
      color: xcolor,
      title: xtitle,
      subtitle: xsubtitle,
      content: xcontent,
      ismain: xismain,
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
  tmpobj.innerHTML = '<div class="'+((item.ismain)?'mainman':'boxman')+'">'+
      '<h1 class="'+((item.ismain)?'maintitle':'boxtitle')+'">'+item.title+'</h1>'+
      '<h6 class="'+((item.ismain)?'mainsubtitle':'boxsubtitle')+'">'+item.subtitle+'</h6>'+
      '<div class="boxcontent">'+item.content+'</div>'+
      '</div>'+ 
      ((tmpobj.dataset.before>=0)?'<button class="navButton prevButton" onClick="prevButton(this.parentElement)">back</button>':'')+
      ((tmpobj.dataset.after>=0)?'<button class="navButton nextButton" onClick="nextButton(this.parentElement)">next</button>':'');

  container.appendChild(tmpobj);
  if (item.ismain) { activeBlock = tmpobj; }
}

function changeBox(theobj) {
  if (theobj.dataset.position!=activeBlock.dataset.position) {
    theobj.style.zIndex='5';
    theobj.style.opacity = '1';
    setTimeout( function( activeBlock, theobj ) { 
      theobj.style.zIndex='10'; 
      activeBlock.style.zIndex='0';  
      activeBlock = theobj; 
      }, 1000, activeBlock, theobj
    );
    activeBlock.style.opacity = '0';
  }
}

function nextButton(theobj) {
  tmpnxt = document.getElementById('bloque_' + theobj.dataset.after);
  tmpnxt.style.zIndex='5';
  tmpnxt.style.opacity = '1';
  setTimeout( function( theobj, tmpnxt ) { 
      tmpnxt.style.zIndex='10'; 
      theobj.style.zIndex='0';  
      activeBlock = tmpnxt; 
      }, 1000, theobj, tmpnxt
  );
  theobj.style.opacity = '0';
}

function prevButton(theobj) {
  tmpprv = document.getElementById('bloque_' + theobj.dataset.before);
  tmpprv.style.zIndex='5';
  tmpprv.style.opacity = '1';
  setTimeout( function( theobj, tmpprv ) { 
      tmpprv.style.zIndex='10'; 
      theobj.style.zIndex='0';  
      activeBlock = tmpprv; 
      }, 1000, theobj, tmpprv
  );
  theobj.style.opacity = '0';
}
