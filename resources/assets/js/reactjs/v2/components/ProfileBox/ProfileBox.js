import React from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import Portrait from '../Portrait';
import SocialMedia from "../SocialMedia";
import ContactMeModal from "../Modal/ContactMeModal";
import NoPortrait from "../Portrait/NoPortrait";

/** function: PortraitBoxContainer */
const ProfileBox = (props) => {

    const styles = {
        for: {
            profileContainer: {
                width: '100%',
                textAlign: 'center',
                display: 'inline-block',
                marginTop: '47px',
                position: 'relative'
                /*position: "absolute",
                top: "-70px",
                left: '110px'*/
            },
            portraitBoxContainer: {
                width: "300px",
                height: "522px",
                padding: "50px 20px",
                display: "inline-block",
                /*border: "1px solid #bbb",*/
                borderRadius: "20px",
                background: content.colors.banner_form_background,
                position: 'relative'
            },
            profileText: {
                margin: "8px auto",
                color: "#333333",
                display: "inline-block",
                h3: {
                    fontSize: "1.2em",
                    color: "#44b3e9"
                },
                h4: {
                    color: "#777",
                    /*color: '#fff',*/
                    fontSize: "0.9em",
                    textTransform: "UPPERCASE"
                }
            },
            portrait: {
                width: '100%',
                textAlign: 'center',
                display: 'inline-block',
                position: 'relative',
                marginTop: '60px'
            },
            contact: {
              marginRight: '4px'
            },
            image: {
                width: "auto",
                height: "168px",
                margin: "0px auto",
                display: "inline-block",
                borderRadius: "50%",
                boxShadow: "0px 0px 0px 2px #FFF"
            },
            noimage: {
                width: "auto",
                height: "auto",
                margin: "0px auto",
                display: "inline-block",
                visibility: 'hidden',
                boxShadow: "0px 0px 0px 2px #FFF"
            },
            portraitBackdrop: {
                "display" : content && content.portrait ? "block" : "none",
                "position": "absolute",
                "top": "0px",
                "left": "0px",
                "height": "198px",
                "background": "url(https://cdn.nimbusthemes.com/2017/09/09233341/Free-Nature-Backgrounds-Seaport-During-Daytime-by-Pexels.jpeg) rgb(204, 204, 204)",
                "width": "100%",
                "borderBottom": "2px solid rgb(255, 255, 255)",
                "borderTopLeftRadius": "20px",
                "borderTopRightRadius": "20px",
                "opacity": "0.7",
                "backgroundPosition": "-529px -140px"
            },
            contactBtn: {
                "background": "#00c39f",
                "borderColor": "#00c39f"
            }
        },
    };

    let useDiv = content.show_portrait === false;
    let showPortrait = content.show_portrait === true;

    return (
        <div className="profile-container" style={styles.for.profileContainer}>
            <div id="portrait-box-container" style={styles.for.portraitBoxContainer}>
                <div className="portrait-backdrop" style={styles.for.portraitBackdrop}></div>
                <Portrait name="test" src={content.portrait} useDiv={useDiv} showPortrait={showPortrait} className="portrait-container" style={styles}  />
                <div className="profile-text" style={styles.for.profileText}>
                    <h3 style={styles.for.profileText.h3}>{content.name}</h3>
                    <h4 style={styles.for.profileText.h4}>{content.position_title}</h4>
                    <SocialMedia
                        twitter="http://twitter.com"
                        facebook="http://facebook.com"
                        google_plus="https://googleplus.com"
                        linkedIn="https://linkedin.com"
                    />
                    <br/>
                    <ContactMeModal label="Contact" from={content.name} email="tsarlese@agentquote.com"  />
                </div>
            </div>
        </div>
    );
};

ProfileBox.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

ProfileBox.defaultProps = {
    //myProp: val
};

export default ProfileBox;

if (typeof content !== 'undefined' && content.show_portrait) {
    if (document.getElementById('profile-box')) {
        render(
            <ProfileBox />,
            document.getElementById('profile-box')
        );
    }
}