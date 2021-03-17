const VEL = 10;
var Bprin = document.getElementById('bloc-principal');
Bprin.style.bottom = 0 + "px";

function goUp()
{
    function sumarY( y_box )
    {
        y_box += VEL;
        Bprin.style.bottom = y_box + "px";
    }

    var elevar = setInterval( function()
    {
        if ( parseInt(Bprin.style.bottom) != 969 )
        {
            sumarY( parseInt(Bprin.style.bottom) );
        }
        else 
        {
            clearInterval(elevar);
            Bprin.remove();
        }

    }, 1);

    //Bprin.style.bottom = 969 + "px";
}