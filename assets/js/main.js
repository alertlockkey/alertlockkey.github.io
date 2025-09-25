/*
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

// USER ADDED TEXT EFFECT

	function isMobileDevice() {
		return /Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
	}

	const preload = () => {

		let manager = new THREE.LoadingManager();
		manager.onLoad = function() { 
		const environment = new Environment( typo, particle );
		}

		var typo = null;
		const loader = new THREE.FontLoader( manager );
		const font = loader.load('https://res.cloudinary.com/dydre7amr/raw/upload/v1612950355/font_zsd4dr.json', function ( font ) { typo = font; });
		const particle = new THREE.TextureLoader( manager ).load( 'https://res.cloudinary.com/dfvtkoboz/image/upload/v1605013866/particle_a64uzf.png');
		


		// Experimenting for mobile display
		// const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
		// const particle = new THREE.TextureLoader(manager).load(isMobile 
		// 	? 'https://res.cloudinary.com/dfvtkoboz/image/upload/v1605013866/particle_small.png' 
		// 	: 'https://res.cloudinary.com/dfvtkoboz/image/upload/v1605013866/particle_a64uzf.png');
		// End experimenting
	

	}

	if ( document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll))
		preload ();
	else
		document.addEventListener("DOMContentLoaded", preload ); 

	class Environment {

		constructor( font, particle ){ 

		this.font = font;
		this.particle = particle;
		this.container = document.querySelector( '#banner' );
		this.scene = new THREE.Scene();
		this.scene.background = null; //ADDED
		this.createCamera();
		this.createRenderer();
		this.setup()
		this.bindEvents();
		}

		bindEvents(){

		window.addEventListener( 'resize', this.onWindowResize.bind( this ));
		
		}

		setup(){ 

		this.createParticles = new CreateParticles( this.scene, this.font,             this.particle, this.camera, this.renderer );
		}

		render() {
		this.createParticles.render()
		this.renderer.render( this.scene, this.camera )
		
		}

		createCamera() {

		this.camera = new THREE.PerspectiveCamera( 65, this.container.clientWidth /  this.container.clientHeight, 1, 10000 );
		this.camera.position.set( 0,-25, 100 );

		}

		createRenderer() {

		this.renderer = new THREE.WebGLRenderer({ alpha: true });
		this.renderer.setSize( this.container.clientWidth, this.container.clientHeight );

		this.renderer.setPixelRatio( Math.min( window.devicePixelRatio, 2));

		this.renderer.outputEncoding = THREE.sRGBEncoding;

		// this.container.appendChild( this.renderer.domElement );

		const innerDiv = document.querySelector('.inner');  // Get the div where you want the canvas
		innerDiv.insertBefore(this.renderer.domElement, innerDiv.firstChild);  // Insert before text
		
		this.renderer.setAnimationLoop(() => { this.render() });


		}

		onWindowResize(){
			if (isMobileDevice()) {
				this.camera.aspect = window.innerWidth / window.innerHeight;
				this.camera.updateProjectionMatrix();
				this.renderer.setSize(window.innerWidth, window.innerHeight);
			} else {
				this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
				this.camera.updateProjectionMatrix();
				this.renderer.setSize( this.container.clientWidth, this.container.clientHeight );
			}
		}

		// ORIGINAL
		// onWindowResize(){
		// this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
		// this.camera.updateProjectionMatrix();
		// this.renderer.setSize( this.container.clientWidth, this.container.clientHeight );
		// }
		// END ORIGINAL 

		// Experimenting for mobile display
		// onWindowResize() {
		// this.camera.aspect = window.innerWidth / window.innerHeight;
		// this.camera.updateProjectionMatrix();
		// this.renderer.setSize(window.innerWidth, window.innerHeight);
		// }
		// End experimenting
	}

	class CreateParticles {
		
		constructor( scene, font, particleImg, camera, renderer ) {
		
			this.scene = scene;
			this.font = font;
			this.particleImg = particleImg;
			this.camera = camera;
			this.renderer = renderer;
			
			this.raycaster = new THREE.Raycaster();
			this.mouse = new THREE.Vector2(-200, 200);
			
			this.colorChange = new THREE.Color();

			this.buttom = false;

			// this.data = {
			// 	text: 'ALERT LOCK & KEY',
			// 	amount: 1500,
			// 	particleSize: 1,
			// 	particleColor: 0xffffff,
			// 	textSize: 16,
			// 	area: 250,
			// 	ease: .05,
			// }

			if (isMobileDevice()) {
				this.data = {
					text: 'ALERT \nLOCK \n    & \n  KEY',
					amount: 500,  // Reduce particles on mobile
					particleSize: 0.5,
					particleColor: 0xffffff,
					textSize: 10,
					area: 150,
					ease: 0.05,
				};
			} else {
				this.data = {
					text: 'ALERT LOCK & KEY',
					amount: 1500,
					particleSize: 1,
					particleColor: 0xffffff,
					textSize: 16,
					area: 250,
					ease: .05,
				}
			}

			// Experimenting for mobile display
			// this.data = {
			// 	text: 'ALERT LOCK & KEY',
			// 	amount: isMobile ? 500 : 1500,  // Reduce particles on mobile
			// 	particleSize: isMobile ? 0.5 : 1,
			// 	particleColor: 0xffffff,
			// 	textSize: isMobile ? 10 : 16,
			// 	area: 150,
			// 	ease: 0.05,
			// };
			// End experimenting

			this.setup();
			this.bindEvents();

		}


		setup(){

			this.colorsList = [
				new THREE.Color(0x000000), // Black
				new THREE.Color(0xffffff), // White
				new THREE.Color(0xcf2e2e), // Red (#cf2e2e)
			];

			const geometry = new THREE.PlaneGeometry( this.visibleWidthAtZDepth( 100, this.camera ), this.visibleHeightAtZDepth( 100, this.camera ));
			const material = new THREE.MeshBasicMaterial( { color: 0x00ff00, transparent: true } );
			this.planeArea = new THREE.Mesh( geometry, material );
			this.planeArea.visible = false;
			this.createText();

		}

		bindEvents() {

			let tapTimeout, holdTimeout;
			let tapCount = 0;
			
			function handleDoubleTapHoldStart(event) {
				if (tapCount === 0) {
					tapCount++;
					tapTimeout = setTimeout(() => (tapCount = 0), 300); // Reset tap count after 300ms if no second tap
				} else {
					clearTimeout(tapTimeout); // Clear the double-tap timeout
					tapCount = 0;
			
					// Set up a timeout for "hold" after the double-tap is detected
					holdTimeout = setTimeout(() => {
						this.onTouchStart(event); // Run the intended behavior on double-tap hold
					}, 500); // Adjust this time for hold delay
				}
			}

			document.addEventListener( 'mousedown', this.onMouseDown.bind( this ));
			document.addEventListener( 'mouseup', this.onMouseUp.bind( this ));
			// document.addEventListener( 'mousemove', this.onMouseMove.bind( this ));
			// Event listeners for both mouse and touch events
			document.addEventListener("mousemove", this.onPointerMove.bind(this));
			document.addEventListener("touchstart", handleDoubleTapHoldStart.bind(this));
			document.addEventListener("touchmove", this.onPointerMove.bind(this));
			document.addEventListener('touchend', this.onTouchEnd.bind(this));
			
		}

		onMouseDown(){
			
			this.mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
			this.mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;

			const vector = new THREE.Vector3( this.mouse.x, this.mouse.y, 0.5);
			vector.unproject( this.camera );
			const dir = vector.sub( this.camera.position ).normalize();
			const distance = - this.camera.position.z / dir.z;
			this.currenPosition = this.camera.position.clone().add( dir.multiplyScalar( distance ) );
			
			const pos = this.particles.geometry.attributes.position;
			this.buttom = true;
			this.data.ease = .01;
			
		}

		onMouseUp(){

			this.buttom = false;
			this.data.ease = .05;

		}

		onPointerMove(event) {

			if (event.type === "mousemove") {
				this.mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
				this.mouse.y = - (event.clientY / window.innerHeight) * 2 + 1;
				// console.log("what d'ya expect?")
			} else if (event.type === "touchmove" && event.touches.length === 1) {
				this.mouse.x = (event.touches[0].clientX / window.innerWidth) * 2 - 1;
				this.mouse.y = - (event.touches[0].clientY / window.innerHeight) * 2 + 1;
			}

		}

		onTouchStart(event) {

			this.buttom = true;
			this.data.ease = 0.01;

			// Similar to onMouseDown, convert touch coordinates to normalized screen coordinates
			this.mouse.x = (event.touches[0].clientX / window.innerWidth) * 2 - 1;
			this.mouse.y = -(event.touches[0].clientY / window.innerHeight) * 2 + 1;

			const vector = new THREE.Vector3(this.mouse.x, this.mouse.y, 0.5);
			vector.unproject(this.camera);
			const dir = vector.sub(this.camera.position).normalize();
			const distance = -this.camera.position.z / dir.z;
			this.currenPosition = this.camera.position.clone().add(dir.multiplyScalar(distance));

		}

		onTouchEnd(event) {

			this.buttom = false;
			this.data.ease = 0.05;  // Restore easing to the default for smooth return

		}

		// onMouseMove( ) { 

			// Event listeners for both mouse and touch events
			// window.addEventListener("mousemove", onPointerMove.bind(this));
			// window.addEventListener("touchmove", onPointerMove.bind(this));


			// this.mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
			// this.mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;

		// }

		render( level ){ 

			const time = ((.001 * performance.now())%12)/12;
			const zigzagTime = (1 + (Math.sin( time * 2 * Math.PI )))/6;

			this.raycaster.setFromCamera( this.mouse, this.camera );

			const intersects = this.raycaster.intersectObject( this.planeArea );

			if ( intersects.length > 0 ) {

				const pos = this.particles.geometry.attributes.position;
				const copy = this.geometryCopy.attributes.position;
				const coulors = this.particles.geometry.attributes.customColor;
				const size = this.particles.geometry.attributes.size;

				const mx = intersects[ 0 ].point.x;
				const my = intersects[ 0 ].point.y;
				const mz = intersects[ 0 ].point.z;

				for ( var i = 0, l = pos.count; i < l; i++) {

					const initX = copy.getX(i);
					const initY = copy.getY(i);
					const initZ = copy.getZ(i);

					let px = pos.getX(i);
					let py = pos.getY(i);
					let pz = pos.getZ(i);

					// this.colorChange.setHSL( .5, 1 , 1 ) // ORIGINAL
							
					// USER ADDED
					// this.colorChange.setHSL(0, 0, 0);
					this.colorChange.setHSL(0, 0, 1);
					// this.colorChange.setHSL(0.0, 1.0, 0.5);
					// END USER ADDED

					coulors.setXYZ( i, this.colorChange.r, this.colorChange.g, this.colorChange.b )
					coulors.needsUpdate = true;

					size.array[ i ]  = this.data.particleSize;
					size.needsUpdate = true;

					let dx = mx - px;
					let dy = my - py;
					const dz = mz - pz;

					const mouseDistance = this.distance( mx, my, px, py )
					let d = ( dx = mx - px ) * dx + ( dy = my - py ) * dy;
					const f = - this.data.area/d;

					if( this.buttom ){ 

						const t = Math.atan2( dy, dx );
						px -= f * Math.cos( t );
						py -= f * Math.sin( t );

						// this.colorChange.setHSL( .5 + zigzagTime, 1.0 , .5 ) // ORIGINAL
						this.colorChange.setHSL( 0 , 0 , 0 ) // This controls the main color of the text when clicked
						coulors.setXYZ( i, this.colorChange.r, this.colorChange.g, this.colorChange.b )
						coulors.needsUpdate = true;

						if ((px > (initX + 70)) || ( px < (initX - 70)) || (py > (initY + 70) || ( py < (initY - 70)))){

							// this.colorChange.setHSL( .15, 1.0 , .5 ) // ORIGINAL
							this.colorChange.setHSL( 1.0, 1.0 , 0.5 ) // This sets the color of particles when clicks
							coulors.setXYZ( i, this.colorChange.r, this.colorChange.g, this.colorChange.b )
							coulors.needsUpdate = true;

						}

					}else{
					
						if( mouseDistance < this.data.area ){

							if(i%5==0){

								const t = Math.atan2( dy, dx );
								px -= .03 * Math.cos( t );
								py -= .03 * Math.sin( t );

								// this.colorChange.setHSL( .15 , 1.0 , .5 )
								this.colorChange.setHSL( 0 , 1.0 , 0.5 ) // This sets the background text color
								coulors.setXYZ( i, this.colorChange.r, this.colorChange.g, this.colorChange.b )
								coulors.needsUpdate = true;

								size.array[ i ]  =  this.data.particleSize /1.2;
								size.needsUpdate = true;

							}else{

								const t = Math.atan2( dy, dx );
								px += f * Math.cos( t );
								py += f * Math.sin( t );

								pos.setXYZ( i, px, py, pz );
								pos.needsUpdate = true;

								size.array[ i ]  = this.data.particleSize * 1.3 ;
								size.needsUpdate = true;
							}

							if ((px > (initX + 10)) || ( px < (initX - 10)) || (py > (initY + 10) || ( py < (initY - 10)))){

								// this.colorChange.setHSL( .15, 1.0 , .5 )
								this.colorChange.setHSL( 0, 0 , 0 ) // This set the colors of the particles when mouseover
								coulors.setXYZ( i, this.colorChange.r, this.colorChange.g, this.colorChange.b )
								coulors.needsUpdate = true;

								size.array[ i ]  = this.data.particleSize /1.8;
								size.needsUpdate = true;

							}
						}

					}

					px += ( initX  - px ) * this.data.ease;
					py += ( initY  - py ) * this.data.ease;
					pz += ( initZ  - pz ) * this.data.ease;

					pos.setXYZ( i, px, py, pz );
					pos.needsUpdate = true;

				}
			}
		}

		createText(){ 

			let thePoints = [];

			let shapes = this.font.generateShapes( this.data.text , this.data.textSize  );
			let geometry = new THREE.ShapeGeometry( shapes );
			geometry.computeBoundingBox();
		
			const xMid = - 0.5 * ( geometry.boundingBox.max.x - geometry.boundingBox.min.x );
			const yMid =  (geometry.boundingBox.max.y - geometry.boundingBox.min.y)/2.85;

			geometry.center();

			let holeShapes = [];

			for ( let q = 0; q < shapes.length; q ++ ) {

				let shape = shapes[ q ];

				if ( shape.holes && shape.holes.length > 0 ) {

					for ( let  j = 0; j < shape.holes.length; j ++ ) {

						let  hole = shape.holes[ j ];
						holeShapes.push( hole );
					}
				}

			}
			shapes.push.apply( shapes, holeShapes );

			let colors = [];
			let sizes = [];
						
			for ( let  x = 0; x < shapes.length; x ++ ) {

				let shape = shapes[ x ];

				const amountPoints = ( shape.type == 'Path') ? this.data.amount/2 : this.data.amount;

				let points = shape.getSpacedPoints( amountPoints ) ;

				points.forEach( ( element, z ) => {
							
					const a = new THREE.Vector3( element.x, element.y, 0 );
					thePoints.push( a );
					// colors.push( this.colorChange.r, this.colorChange.g, this.colorChange.b); //ORIGINAL
					// USER ADDED
					const color = this.colorsList[Math.floor(Math.random() * this.colorsList.length)];
					colors.push(color.r, color.g, color.b)
					// END USER ADDED

					sizes.push( 1 )

					});
			}

			let geoParticles = new THREE.BufferGeometry().setFromPoints( thePoints );
			geoParticles.translate( xMid, yMid, 0 );
					
			geoParticles.setAttribute( 'customColor', new THREE.Float32BufferAttribute( colors, 3 ) );
			geoParticles.setAttribute( 'size', new THREE.Float32BufferAttribute( sizes, 1) );

			const material = new THREE.ShaderMaterial( {

				uniforms: {
					color: { value: new THREE.Color( 0xffffff ) },
					pointTexture: { value: this.particleImg }
				},
				vertexShader: document.getElementById( 'vertexshader' ).textContent,
				fragmentShader: document.getElementById( 'fragmentshader' ).textContent,

				blending: THREE.AdditiveBlending,
				depthTest: false,
				transparent: true,
			} );

			this.particles = new THREE.Points( geoParticles, material );
			this.scene.add( this.particles );

			this.geometryCopy = new THREE.BufferGeometry();
			this.geometryCopy.copy( this.particles.geometry );
			
		}

		visibleHeightAtZDepth ( depth, camera ) {

			const cameraOffset = camera.position.z;
			if ( depth < cameraOffset ) depth -= cameraOffset;
			else depth += cameraOffset;

			const vFOV = camera.fov * Math.PI / 180; 

			return 2 * Math.tan( vFOV / 2 ) * Math.abs( depth );
		}

		visibleWidthAtZDepth( depth, camera ) {

			const height = this.visibleHeightAtZDepth( depth, camera );
			return height * camera.aspect;

		}

		distance (x1, y1, x2, y2){
			
			return Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2));
		}

	}

// END USER ADDED TEXT EFFECT

// CHECKBOX LOGIC CAREERS PAGE

document.querySelectorAll('.question-checkbox').forEach((questionDiv) => {
    questionDiv.addEventListener('change', (event) => {
        if (event.target.type === 'checkbox' && event.target.checked) {
            // Uncheck other checkboxes within the same question group
            questionDiv.querySelectorAll('input[type="checkbox"]').forEach((box) => {
                if (box !== event.target) box.checked = false;
            });
        }
    });
})

// END CHECKBOX LOGIC CAREERS PAGE

var	$window = $(window),
		$body = $('body'),
		$wrapper = $('#page-wrapper'),
		$banner = $('#banner'),
		$header = $('#header');

	// Breakpoints.
		breakpoints({
			xlarge:   [ '1281px',  '1680px' ],
			large:    [ '981px',   '1280px' ],
			medium:   [ '737px',   '980px'  ],
			small:    [ '481px',   '736px'  ],
			xsmall:   [ null,      '480px'  ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});

	// Mobile?
		if (browser.mobile)
			$body.addClass('is-mobile');
		else {

			breakpoints.on('>medium', function() {
				$body.removeClass('is-mobile');
			});

			breakpoints.on('<=medium', function() {
				$body.addClass('is-mobile');
			});

		}

	// Scrolly.
		$('.scrolly')
			.scrolly({
				speed: 1500,
				offset: $header.outerHeight()
			});

	// Menu.
		$('#menu')
			.append('<a href="#menu" class="close"></a>')
			.appendTo($body)
			.panel({
				delay: 500,
				hideOnClick: true,
				hideOnSwipe: true,
				resetScroll: true,
				resetForms: true,
				side: 'right',
				target: $body,
				visibleClass: 'is-menu-visible'
			});

	// Header.
		if ($banner.length > 0
		&&	$header.hasClass('alt')) {

			$window.on('resize', function() { $window.trigger('scroll'); });

			$banner.scrollex({
				bottom:		$header.outerHeight() + 1,
				terminate:	function() { $header.removeClass('alt'); },
				enter:		function() { $header.addClass('alt'); },
				leave:		function() { $header.removeClass('alt'); }
			});

		}

})(jQuery);