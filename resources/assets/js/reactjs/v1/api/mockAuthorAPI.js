import delay from './delay';

// This file mocks a web API by working with the hard-coded data below.
// It uses setTimeout to simulate the delay of an AJAX call.
// All calls return promises.
const authors = [
    {
        id:'corry-house',
        firstName: 'Cory',
        lastName: 'House'
    },
    {
        id:'scott-allen',
        firstName: 'Scott',
        lastName: 'Allen'
    },
    {
        id:'dan-wahlin',
        firstName: 'Dan',
        lastName: 'Wahlin'
    }
];

// This would be performed on the server in a real app. Just stubbing it.
const generateId = (author) => {
    return author.firstName.toLowerCase() + '-' + author.lastName.toLowerCase();
};

class AuthorAPI {
    static getAllAuthors() {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                console.log(['Authors'], authors);
                resolve(Object.assign([], authors))
            }, delay);
        })
    }

    static saveAuthor(author) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                // Simulate server-side validation
                const minAuthorNameLength = 3;
                if (author.firstName.length < minAuthorNameLength) {
                    reject(`First Name must be at least ${minAuthorNameLength} characters.`);
                }

                if (author.lastName.length < minAuthorNameLength) {
                    reject(`First Name must be at least ${minAuthorNameLength} characters.`);
                }
                if (author.id) {
                    const existingAuthorIndex = authors.findIndex(a => a.id === author.id );
                    authors.splice(existingAuthorIndex, 1, author);
                } else {
                    // Just simulating creating here.
                    // The server would generate ids for new authors in a real app.
                    // Cloning so copy returned is passed by value rather than by reference
                    author.id = generateId(author);
                    authors.push(author);
                }
                resolve(Object.assign({}, authors))
            }, delay);
        })
    }

    static deleteAuthor(authorId) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                const indexAuthorToDelete = authors.findIndex(author => {
                   return author.id === authorId;
                });
                authors.splice(indexAuthorToDelete, 1);
                resolve();
            }, delay) ;
        });
    }
}

export default AuthorAPI;
