window.JSLoader = (function(s) {
    let $ = {
        fn: (function() {
           return {
               script: function (s) {
                   let el = document.createElement("script");
                   el.setAttribute("src", s);
                   document.body.appendChild(el);
               }
           }
        }())
    };

    return {
        creator: $.fn.script
    };

}());

window.Loader = (function(loaders) {
    return {
        script: function (s) {
            loaders.script(s);
            return this;
        },
        echo: function(s) {
            console.log(s);
            return this;
        },
        store: function(payload) {
            console.log("payload: " + payload);
            let data = new FormData();
            data.append(  "data", JSON.stringify( payload ) );

            fetch("/store/index.php",
                {
                    method: "POST",
                    body: data
                })
                .then(function(res){ return res.json(); })
                .then(function(data){ console.log( data  ) })
                .catch(error => console.log(error))
        },
        getHymn: function (n, url) {
            fetch(url)
                .then(response => response.text())
                .then( data => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(data, "text/html");
                   // doc.querySelector('.line');
                    console.log(doc);
                    let page = {};

                    let title = doc.querySelector('.titlebox h3 a span.white').innerHTML;
                    let verses = doc.querySelectorAll('.verse');



                    let titlePieces = title.split("-");

                    titlePieces = titlePieces.map(item => {
                       return item.replace(" ", "");
                    });

                    page.title = titlePieces[1];
                    page.category = titlePieces[1];

                    console.log("\n\n\nHymn #: " + n);
                    console.log("Category: " + titlePieces[0]);
                    console.log("Title: " + titlePieces[1]);
                    for(let i=0; i < verses.length; i++) {
                        let verse = verses[i];
                        let p = verse.querySelectorAll('p');
                        page.verses = [];
                        for(let j=0; j < p.length; j++) {
                            if (p.className !== "greenbox") {
                               // page.verses.push(p[j].innerHTML);
                                console.log(p[j].innerHTML);
                            }
                        }
                        //console.log(lines[i].innerHTML);
                    }
                    this.store(page);

                }).catch(error => {
                console.log(error);
                });

            return this;
        }
    }
}({
    script: window.JSLoader.creator
}));

(function () {
    for(let i=1; i <= 1352; i++) {
        window.Loader.getHymn(i, "/html/hymns/" + i + ".html");
    }
}());

window.Loader.script("https://code.jquery.com/jquery-3.3.1.min.js");