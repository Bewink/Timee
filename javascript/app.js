/**
 * Created by flo on 29/01/15.
 */
(function() {

    var storage = {};

    function addEvent(element, event, func) {
        if(element.attachEvent) {
            element.attachEvent('on' + event, func);
        }
        else {
            element.addEventListener(event, func, true);
        }
    }

    function init() {
        var elements = document.getElementsByTagName('div'),
            elementsLength = elements.length;

        for (var i = 0; i < elementsLength ; i++) {
            if (elements[i].className === 'draggableBox'){
                addEvent(elements[i], 'mousedown', function(e){
                    var s = storage;
                    s.target = e.target || event.srcElement;
                    s.offsetX = e.clientX - s.target.offsetLeft;
                    s.offsetY = e.clientY - s.target.offsetTop;

                });

                addEvent(document.body, 'mouseup', function() {
                    storage = {}
                    ;
                });
            }
        }

        addEvent(document, 'mousemove', function(e) {
            var target = storage.target;

            if (target) {
                target.style.top = e.clientY - storage.offsetY + 'px';
                target.style.left = e.clientX - storage.offsetX + 'px';
            }
        });
    }

    init();
})();