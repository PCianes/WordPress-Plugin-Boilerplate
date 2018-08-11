/**
 * Block dependencies
 */
import icon from './icon';
import './style.scss';

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { InspectorControls } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Spinner, withAPIData, ServerSideRender, PanelBody, RangeControl } = wp.components;

/**
 * To avoid use withAPIData in editor
 * see https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 * and only return the component ServerSideRender and controls but not declare here attributes
 * edit( { attributes, setAttributes } ) {
			// ensure the block attributes matches this plugin's name
			const { number } = attributes;
			return (
				<div>
					<ServerSideRender
						block="plugin-name/block-name-dynamic"
						attributes={ attributes }
					/>
					<InspectorControls>
						<PanelBody>
							<RangeControl
								beforeIcon="arrow-left-alt2"
								afterIcon="arrow-right-alt2"
								label={ __( 'Range Control', 'plugin-name' ) }
								value={ number }
								onChange={ number => setAttributes( { number } ) }
								min={ 1 }
								max={ 10 }
							/>
						</PanelBody>
					</InspectorControls>
				</div>
			);
		},
 */

registerBlockType(
    'plugin-name/block-name-dynamic',
    {
        title: __( 'Example - Dynamic Block', 'plugin-name'),
        description: __( 'A look at how to build a basic dynamic block.', 'plugin-name'),
        icon: {
            background: 'rgba(254, 243, 224, 0.52)',
            src: icon,
        },
        category: 'plugin-name',
        edit: withAPIData( props => {
                return {
                    posts: `/wp/v2/posts?per_page=3`
                };
            } )( ( { posts, className, isSelected, setAttributes } ) => {
                if ( ! posts.data ) {
                    return (
                        <p className={className} >
                            <Spinner />
                            { __( 'Loading Posts', 'plugin-name' ) }
                        </p>
                    );
                }
                if ( 0 === posts.data.length ) {
                    return <p>{ __( 'No Posts', 'plugin-name' ) }</p>;
                }
                return (
                    <ul className={ className }>
                        { posts.data.map( post => {
                            return (
                                <li>
                                    <a className={ className } href={ post.link }>
                                        { post.title.rendered }
                                    </a>
                                </li>
                            );
                        }) }
                    </ul>
                );
            } ) // end withAPIData
        , // end edit
        save() {
            // Rendering in PHP
            return null;
        },
} );
