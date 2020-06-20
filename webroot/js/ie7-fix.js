// shim for older browsers:
if (!document.getElementsByClassName) {
    document.getElementsByClassName = (function(){
        // Utility function to traverse the DOM:
        function traverse (node, callback) {
            callback(node);
            for (var i=0;i < node.childNodes.length; i++) {
                traverse(node.childNodes[i],callback);
            }
        }

        // Actual definition of getElementsByClassName
        return function (name) {
            var result = [];
            traverse(document.body,function(node){
                if (node.className == name) {
                    result.push(node);
                }
            });
            return result;
        }
    })()
}