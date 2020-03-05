import React from 'react';
import AppRequestModal from '../../Modal/AppRequestModal';

/** function: AppRequestButton */
const AppRequestButton = ({style, link}) => {
    return (
        <div className="col-4" style={style}>
            <AppRequestModal label="App Request" />
        </div>
    );
};

export default AppRequestButton;
