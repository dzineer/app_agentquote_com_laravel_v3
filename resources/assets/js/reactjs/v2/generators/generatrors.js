let generators = {

};

/**
 * Returns a random number between min (inclusive) and max (exclusive)
 */
function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}

generators.generateId = () => {
    return getRandomArbitrary(1200, 2400);
};

module.exports = generators;