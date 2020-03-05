const css = {
    containerSwitch: {
        width: '100%',
        height: '53px',
        padding: '4px',
        background: '#E3E3E3',
        borderRadius: '2px',
        margin: '18px 0px'
    },
    switchInput: {
        display: 'none'
    },
    /* select every .switch-label immediately after .switch-input that is checked */
    switchLabelChecked: {
        background: 'linear-gradient(to bottom, #ff9800 0%, #ff9800 100%)',
        color: 'white',
    //  borderRadius: '2px',
        textShadow: '0 1px rgba(4,4,4,0.2)',
        backgroundImage: 'linear-gradient(top bottom, #ff9800, #eeeeee)',
    //    border: '1px solid #FF8822',
    //    borderRadiusTopRight: '0 !important',
    //    borderRadiusBottomRight: '0 !important',
        filter: 'progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ff9800\', endColorstr=\'#ff9800\',GradientType=0 )',
        paddingTop: '0.5rem',
        paddingBottom: '0.2rem'
    },
    checkedLeft: {
        borderTopRightRadius: 'unset!important',
        borderBottomRightRadius: 'unset !important'
    },
    checkedRight: {
        borderTopLeftRadius: 'unset !important',
        borderBottomLeftRadius: 'unset !important',
    },
    switchLabel: {
    //    float: 'left',
        width: '50%',
        color: '#555555',
        textAlign: 'center',
        textShadow: '0 -1px rgba(0,0,0,0.1)',
        cursor: 'pointer',
        display: 'block !important',
        letterSpacing: '0.05em',
     //   padding: '0.5rem 0.75rem',
     //   fontSize: '14px',
        backgroundColor: '#fff',
        backgroundImage: 'none',
        border: '1px solid #ccc',
    //    borderRadius: '4px',
        boxShadow: 'inset 0 1px 1px rgba(0, 0, 0, .075)',
        transition: 'border-color ease-in-out .15s, box-shadow ease-in-out .15s',
        padding: '0.425rem 0.75rem'
    },
    switchRight: {
        borderTopLeftRadius: 'unset !important',
        borderBottomLeftRadius: 'unset !important',
        height: '43px',
        float: 'right',
        width: '50%',
        lineHeight: '1.8',
        textAlign: 'center',
        textShadow: '0 -1px rgba(0,0,0,0.1)',
        cursor: 'pointer'
    },
    switchLeft: {
        float: 'left',
        width: '50%',
        height: '43px',
        lineHeight: '1.8',
        textAlign: 'center',
        textShadow: '0 -1px rgba(0,0,0,0.1)',
        cursor: 'pointer',
        borderTopRightRadius: 'unset !important',
        borderBottomRightRadius: 'unset !important'
    }
};

export default css;