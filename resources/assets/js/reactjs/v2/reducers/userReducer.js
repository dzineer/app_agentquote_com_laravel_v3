const userReducer = (state = '', {type, payload}) => {
    switch(type) {
        case 'updateUser':
            return payload.user;
    }
    return state;
};
export default userReducer;