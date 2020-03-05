import { LoremIpsum } from "lorem-ipsum";
const lorem = new LoremIpsum({
  sentencesPerParagraph: {
    max: 8,
    min: 4
  },
  wordsPerSentence: {
    max: 16,
    min: 4
  }
});



export default {
    featured(n) {
        return n || Math.round(Math.random());
    },
    body(n) {
        return n ? lorem.generateSentences(1) : lorem.generateSentences(n);
    },
    wordList(n) {
        return lorem.generateWords(n);
    },
    paragraph(n) {
        return this.body(n);
    },
    titleCase(str) {
        var splitStr = str.toLowerCase().split(' ');
        for (var i = 0; i < splitStr.length; i++) {
            // You do not need to check if i is larger than splitStr length, as your for does that for you
            // Assign it back to the array
            splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
        }
        // Directly return the joined string
        return splitStr.join(' ');  
    },
    name(len) {
        return this.titleCase(lorem.generateWords( Math.floor(Math.random() * 3 ) + 1))
    },
    company(len) {
        const types = [', Inc.', ' Corp', ' Enterprises'];
        return this.titleCase(lorem.generateWords( Math.floor(Math.random() * 3 ) + 1))  + types[  Math.floor(Math.random() * types.length) ];
    },
    link(customTld) {
        let tlds = ['.com', '.net', '.gov'];
        let tld = tlds[Math.floor(Math.random() * tlds.length)];
        return customTld ? 'https://' + 'www.' + lorem.generateWords( 1 ) + customTld :
                           'https://' + 'www.' + lorem.generateWords( 1 ) + tld;
    },
    avatar(v) {
        return `http://placeimg.com/640/480/any?${v}`;
    }
}