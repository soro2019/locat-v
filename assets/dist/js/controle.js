function controleInventaire(){
    var box = bootbox.confirm({ 
        size: "small",
        message: "Complete inventory, If you are sure click OK; if not CANCEL",
        callback: function(result){ 
             /* result is a boolean; true = OK, false = Cancel*/
             if(result==true)
             {
                var url = document.getElementById('urlcode').value;
                window.setTimeout(function(){
                        // Move to a new location or you can do something else
                        window.location.href =  url;

                    }, 300);
                //window.location.href = url;
             }
      }
    })
 }
function contolervalue(){
    var point0 = document.getElementById('reponses').value;
    var point1 = document.getElementById('name_prod').value;
    var point2 = document.getElementById('ref').value;
    if (point0==" " || point0=="") {
        if (point1==" " || point1=="") {
            if (point2==" " || point2=="") {
                document.getElementById('reponses').required=true;
                document.getElementById('name_prod').required=true;
                document.getElementById('ref').required=true;
                alert('Fill in at least one of the three fields');
            }
        }
    }
   
}
$(document).ready(function() {
    $('#reponses,#name_prod,#ref').change(function(){
        document.getElementById('reponses').required=false;
        document.getElementById('name_prod').required=false;
        document.getElementById('ref').required=false;
    });
    $('#reponses,#name_prod,#ref').keyup(function(){
        document.getElementById('reponses').required=false;
        document.getElementById('name_prod').required=false;
        document.getElementById('ref').required=false;
    });
});

Quagga.init(
        {
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#camera') // Or '#yourElement' (optional)
            },
            locator: {
                patchSize: "medium",
                halfSample: true
            },
            decoder: {
                readers: [
                'code_128_reader',
                'ean_reader',
                'code_39_reader',
                'ean_8_reader',
                '2of5_reader'
                ]
                
            },
            locate: true
        }, 
        function(error) {
            if (error) {
                console.log(error);
                return
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        }
    );
    Quagga.onProcessed(function(result) {
        var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;

        if (result) {
            if (result.boxes) {
                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                result.boxes.filter(function (box) {
                    return box !== result.box;
                }).forEach(function (box) {
                    Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                });
            }

            if (result.box) {
                Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
            }

            if (result.codeResult && result.codeResult.code) {
                Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3/*,beep: '<?=site_url('/assets/js/dist')?>/audio/beep.mp3'*/});
                var audio = new Audio(document.getElementById('urlpasse').value + 'assets/js/dist/audio/beep.mp3');
                audio.play();
            }
        }
    });
    Quagga.onDetected(function(data) {
        console.log(data);
        document.querySelector('#reponses').value = data.codeResult.code;
        var info = document.querySelector('#reponses').value;

    });