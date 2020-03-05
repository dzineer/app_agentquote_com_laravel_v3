// Return the width of a percentage of total width, as an integer
let DomainValidator  = {

};

DomainValidator.validate = (str) => {
    const re = new RegExp(/^((?:(?:(?:\w[\.\-\+]?)*)\w)+)((?:(?:(?:\w[\.\-\+]?){0,62})\w)+)\.(\w{2,6})$/);
    return str.match(re);
};

export default DomainValidator;
