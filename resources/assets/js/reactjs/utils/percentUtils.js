// Return the width of a percentage of total width, as an integer
let utils  = {

};

utils.getWidthAsPercentage = (percent, totalWidth) => {
    return parseInt(totalWidth * (percent / 100), 10);
};

export default utils;