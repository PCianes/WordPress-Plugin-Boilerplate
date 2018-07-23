/**
 * Block dependencies
 */
import classnames from 'classnames';
import icon from './icon';
import './style.scss';
import './editor.scss';

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const {
    registerBlockType,
} = wp.blocks;
const {
    RichText,
    AlignmentToolbar,
    BlockControls,
    BlockAlignmentToolbar,
} = wp.editor;
const {
    Dashicon,
    Toolbar,
    Button,
    Tooltip,
} = wp.components;

/**
 * Register block
 */
export default registerBlockType(
    'plugin-name/custom-toolbar',
    {
        title: __( 'Basic example with toolbar', 'plugin-name' ),
        description: __( 'An example of how to add a custom buttom to the block toolbar.', 'plugin-name'),
        category: 'plugin-name',
        icon: {
            background: 'rgba(254, 243, 224, 0.52)',
            src: icon,
        },
        keywords: [
            __( 'Button', 'plugin-name' ),
            __( 'Settings', 'plugin-name' ),
            __( 'Controls', 'plugin-name' ),
        ],
        attributes: {
            alignment: {
                type: 'string',
            },
            blockAlignment: {
                type: 'string',
            },
            highContrast: {
                type: 'boolean',
                default: false,
            },
            message: {
                type: 'array',
                source: 'children',
                selector: '.message-body',
            },
        },
        edit( { attributes, className, setAttributes } ) {
            const { alignment, blockAlignment, message, highContrast } = attributes;
            return (
                <div className={ classnames( className, { 'high-contrast': highContrast } ) }>
                    <BlockControls key="custom-controls">
                        <BlockAlignmentToolbar
                            value={ blockAlignment }
                            onChange={ blockAlignment => setAttributes( { blockAlignment } ) }
                        />
                        <AlignmentToolbar
                            value={ alignment }
                            onChange={ alignment => setAttributes( { alignment } ) }
                        />
                        <Toolbar>
                            <Tooltip text={ __( 'High Contrast', 'plugin-name' )  }>
                                <Button
                                    className={ classnames( 'components-icon-button','components-toolbar__control',
                                        { 'is-active': highContrast } ) }
                                    onClick={ () => setAttributes( { highContrast: ! highContrast } ) }
                                >
                                    { icon }
                                </Button>
                            </Tooltip>
                        </Toolbar>
                    </BlockControls>
                    <RichText
                        tagName="div"
                        multiline="p"
                        placeholder={ __( 'Enter your message here..', 'plugin-name' ) }
                        value={ message }
                        className={ classnames( 'message-body', { 'high-contrast': highContrast } ) }
                        style={ { textAlign: alignment } }
                        onChange={ ( message ) => setAttributes( { message } ) }
                    />
                </div>
            );
        },
        save( { attributes : { highContrast, alignment, message } } ) {
            return (
                <div
                    className={ classnames( 'message-body', { 'high-contrast': highContrast } )}
                    style={ { textAlign: alignment } }
                >
                    { message }
                </div>
            )
        },

    },
);
