/**
 * jquery.als.js
 * http://als.musings.it 
 * jQuery plugin for list scrolling (any list with any content)
 * developed for http://www.musings.it and released as a freebie
 *  
 * animations: horizontal slide, vertical slide of lists
 * types of lists: images, texts, inserted as div or as ul - li
 * CONFIGURABLE PARAMETERS
 * visible_elements: number of visible elements of a list
 * scrolling_items: list scrolling step
 * orientation: list orientation (horizontal or vertical)
 * circular: yes for infinite list scrolling, no on the contrary
 * autoscroll: yes for automatic scrolling, no on the contrary
 * interval: if autoscroll "yes" is the time interval between scrolling movements
 * direction: if autoscroll "yes" is the scrolling direction (left,right,up,down)
 * start_from: start the scroller from a specific item (default: 0, first item)
 * 
 * CONFIGURATION EXAMPLE:
 * $("#lista").als({
 *					visible_items: 4,
 *					scrolling_items: 2,
 *					orientation: "horizontal",
 *  				circular: "yes",
 *					autoscroll: "yes",
 *					interval: 5000,
 *					direction: "right",
 * 					start_from: 0
 *				});
 * 
 * @author Federica Sibella
 * Copyright (c) 2012/13 Federica Sibella - musings(at)musings(dot)it | http://www.musings.it
 * Released with double license MIT o GPLv3.
 * Date: 2013/04/11
 * @version 1.1
 * 
 * changelog:
 * 2013.04.11: added "start_from" option
 */

 
 (function($){
	/**********************************************************
	 * Variabili: als (contains data of the current instance),
	 * instance (number of the current instance),
	 * methods (methods of als plugin)
	 *********************************************************/
	var als = [],
		instance = 0;
	var	methods = {
		/******************************************************
		 * plugin inizialization
		 * @param {Object} options: configuration options
		 ******************************************************/
		init: function(options){
			this.each(function(){
				var defaults = {
					visible_items: 3,
					scrolling_items: 1,
					orientation: "horizontal",
					circular: "no",
					autoscroll: "no",
					interval: 4000,
					direction: "left",
					start_from: 0
				},
				$obj = $(this),
				data = $obj.data('als'),
				$options = $(),
				$item = $(),
				$wrapper = $(),
				$viewport = $(),
				$prev = $(),
				$next = $(),
				num_items = 0,
				viewport_width = 0,
				wrapper_width = 0,
				viewport_height = 0,
				wrapper_height = 0,
				initial_movement = 0,
				i = 0,
				j = 0,
				current = 0,
				timer = 0;
				
				$options = $.extend(defaults, options);
				
				/*********************************************************************
				 * configuration controls: autoscroll option implies
				 * infinite circular scrolling
				 *********************************************************************/
				if($options.circular == "no" && $options.autoscroll == "yes")
				{
					$options.circular = "yes";
				}
				
				/***********************************************************************************
				 * define ID for the different plugin section to name them directly
				 **********************************************************************************/
				if(!$obj.attr("id") || $obj.attr("id") == "")
				{
					$obj.attr("id","als-container_" + instance);
				}
				$viewport = $obj.find(".als-viewport").attr("id","als-viewport_" + instance);
				$wrapper = $obj.find(".als-wrapper").attr("id","als-wrapper_" + instance);
				$item = $obj.find(".als-item");
				num_items = $item.size();
				
				/***************************************************************************************
				 * configuration controls: number of visible element can not be higher than 
				 * total number of list element and scrolling items can not be more
				 * than visible items
				 * start_from number can not be higher than total number of list elements
				 ***************************************************************************************/
				if($options.visible_items > num_items)
				{
					$options.visible_items = num_items - 1;
				}
				
				if($options.scrolling_items > $options.visible_items)
				{
					$options.scrolling_items = $options.visible_items - 1;
				}
				
				if($options.start_from > num_items - $options.visible_items)
				{
					$options.start_from = 0;
				}
				
				/******************************************************
				 * prev and next button inizialization (if present)
				 ******************************************************/
				$prev = $obj.find(".als-prev").attr("data-id","als-prev_" + instance);
				$next = $obj.find(".als-next").attr("data-id","als-next_" + instance);
				
				/*********************************************************************
				 * relative to chosen orientation I calculate width and height
				 * of the list wrapper (wrapper) and of the list viewport
				 * (viewport)
				 * @param {Object} index: internal elements index
				 *********************************************************************/
				switch($options.orientation)
				{
					case "horizontal":
					default:
						$item.each(function(index)
						{
							wrapper_width += $(this).outerWidth(true);
							if(i < $options.visible_items)
							{
								viewport_width += $(this).outerWidth(true);
								i++;
							}
							$(this).attr("id","als-item_" + instance + "_" + index);
							if($options.start_from != 0)
							{
								if(j < $options.start_from)
								{
									initial_movement += $(this).outerWidth(true);
									j++;
								}
								current = $options.start_from;
							}
						});
						$wrapper.css("width", wrapper_width);
						$item.css("left", -initial_movement);
						$viewport.css("width", viewport_width);
						$wrapper.css("height", $item.outerHeight(true));
						$viewport.css("height", $item.outerHeight(true));
						
						if($options.circular == "yes" && $options.start_from != 0)
						{
							/****************************************************
							 * must reset the hidden elements if start_from != 0
							 ****************************************************/
							for (r = 0; r < $options.start_from; r++)
							{
								var position = $item.last().position(),
									riposizionamento_dx = position.left + $item.last().outerWidth(true);
								$item.eq(r).css("left", riposizionamento_dx);
							}	
						}
					break;
					case "vertical":
						$item.each(function(index)
						{
							wrapper_height += $(this).outerHeight(true);
							if(i < $options.visible_items)
							{
								viewport_height += $(this).outerHeight(true);
								i++;
							}
							$(this).attr("id","als-item_" + instance + "_" + index);
							if($options.start_from != 0)
							{
								if(j < $options.start_from)
								{
									initial_movement += $(this).outerHeight(true);
									j++;
								}
								current = $options.start_from;
							}
						});
						$wrapper.css("height", wrapper_height);
						$item.css("top", -initial_movement);
						$viewport.css("height", viewport_height);
						$wrapper.css("width", $item.outerWidth(true));
						$viewport.css("width", $item.outerWidth(true));
						
						if($options.circular == "yes" && $options.start_from != 0)
						{
							/****************************************************
							 * must reset the hidden elements if start_from != 0
							 ****************************************************/
							for (r = 0; r < $options.start_from; r++)
							{
								var position = $item.last().position(),
									riposizionamento_bottom = position.top + $item.last().outerHeight(true);
								$item.eq(r).css("top", riposizionamento_bottom);
							}	
						}
					break
				}
				/**************************************************
				 * if circular == no don't show prev button
				 * at the beginning but only if start_from == 0
				 **************************************************/
				if($options.circular == "no")
				{
					if($options.start_from == 0)
					{
						$prev.css("display","none");
					}
					if($options.visible_items + $options.start_from == num_items)
					{
						$next.css("display","none");
					}
				}
				
				/**************************************************
				 * saving instance parameters in a variable (data)
				 * for future use
				 **************************************************/
				$obj.data('als',
				{
					container : $obj,
					instance : instance,
					options : $options,
					viewport : $viewport,
					wrapper : $wrapper,
					prev : $prev,
					next : $next,
					item : $item,
					num_items : num_items,
					wrapper_width : wrapper_width,
					viewport_width : viewport_width,
					wrapper_height : wrapper_height,
					viewport_height : viewport_height,
					current : current,
					timer : timer
				});
				
				data = $obj.data('als');
				als[instance] = data;
				
				/******************************************
				 * prev and next buttons inizialization
				 ******************************************/
				
				$next.on("click",nextHandle);
				$prev.on("click",prevHandle);
				
				/*********************************************
				 * automatic scrolling function inizialization
				 * if it is the case
				 *********************************************/
				if ($options.autoscroll == "yes") 
				{
					$.fn.als('start',instance);
					$wrapper.hover(function()
					{
						$.fn.als('stop',$(this).attr("id"));
					},function()
					{
						$.fn.als('start',$(this).attr("id"));
					});
				}
				else if ($options.autoscroll == "no") {
					$.fn.als('stop',instance);
				}
				
				/*******************************************
				 * increasing instance number and
				 * returning als variable now inizialized
				 ******************************************/
				instance++;
				return als;
			});
		},
		/*****************************************************
		 * step function for lists elements
		 * @param {Object} id: instance or ID of the element
		 * that calls the function
		 *****************************************************/
		next: function(id){
			id = find_instance(id);
			var data = als[id],
				k1 = 0, k2 = 0;
			/***************************************************
			 * depending on list orientation I calculate
			 * the element horizontal or vertical movement
			 ***************************************************/
			switch(data.options.orientation)
			{
				/*****************************************
				 * list orientation: horizontal
				 ****************************************/
				case "horizontal":
				default:
					var spostamento_sx = 0,
						viewport_width = 0;
					/************************************************
					 * depending on scrolling type I calculate
					 * the movement and the repositioning of the
					 * list elements
					 ************************************************/
					switch(data.options.circular)
					{
						/****************************
						 * infinite scrolling: no
						 ****************************/
						case "no":
						default:
							/********************************************************************
							 * I calculate the elements' movement on the basis of the scrolling
							 * items number starting from the current index
							 ********************************************************************/
							for (k1 = data.current; k1 < data.current + data.options.scrolling_items; k1++)
							{
								spostamento_sx += data.item.eq(k1).outerWidth(true);
							}
							
							/****************************************************************
							 * I modify the current element on the basis of the scrolling
							 * elements number
							 ****************************************************************/
							data.current += data.options.scrolling_items;
							
							/*******************************************************************
							 * I calculate the viewport width on the basis of the width of the
							 * elements that will be visible AFTER the animation
							 *******************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) 
							{
								viewport_width += data.item.eq(k2).outerWidth(true);
							}
							
							/********************************************************
							 * I animate the viewport width
							 ********************************************************/
							data.viewport.animate({
								"width": viewport_width
							}, 600);
							
							/**********************************************
							 * I animate the scrolling elements
							 *********************************************/
							data.item.animate({
								"left": "-=" + spostamento_sx
							}, 600);
							/***********************************************************
							 * after the animation of all elements has finished
							 * (deferred object)
							 ***********************************************************/
							data.item.promise().done(function()
							{	/****************************************************
								 * I bind again the "click" action to the prev
								 * and next buttons (unbinded to prevent undesirable
								 * behaviour during the scrolling animation)
								 ***************************************************/
								data.next.on("click",nextHandle);
								data.prev.on("click",prevHandle);
							});
							/**********************************************************
							 * visibility control of the prev and next buttons
							 **********************************************************/
							if(data.current > 0)
							{
								data.prev.show();
							}
							
							if (data.current + data.options.visible_items >= data.num_items) 
							{
								data.next.hide();
							}
						break;
						/****************************
						 * infinite scrolling: yes
						 ***************************/
						case "yes":
							var memo = 0, memo_index = [];
							/**************************************************************************
							 * I calculate displacement and memorize indices of the elements that 
							 * I have to move because they will be then repositioned in the queue
							 **************************************************************************/
							for (k1 = data.current; k1 < data.current + data.options.scrolling_items; k1++)
							{
								var k3 = k1;
								/******************************************************
								 * I control if I exceed the total number of elements
								 ******************************************************/
								if(k1 >= data.num_items)
								{
									k3 = k1 - data.num_items;
								}
								spostamento_sx += data.item.eq(k3).outerWidth(true);
								memo_index[memo]= k3;
								memo ++;
							}
							/****************************************************************
							 * edit current element as a function of the number of elements 
							 * to slide in a single step
							 ****************************************************************/
							data.current += data.options.scrolling_items;
							
							/******************************************************
							 * I control if I exceed the total number of elements
							 ******************************************************/
							if(data.current >= data.num_items)
							{
								data.current -= data.num_items;
							}
							/***********************************************************************
							 * calculating the extent of the viewport based on the items that 
							 * will be visible after scrolling
							 ***********************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) 
							{
								var k4 = k2;
								/*****************************************************
								 * I control if I exceed the total number of elements
								 *****************************************************/
								if(k2 >= data.num_items)
								{
									k4 = k2 - data.num_items;
								}
								viewport_width += data.item.eq(k4).outerWidth(true);
							}
							
							/******************************************************
							 * viewport width animation
							 ******************************************************/	
							data.viewport.animate({
								"width": viewport_width
							}, 600);
							
							/******************************************************************
							 * scrolling animation of elements and repositioning of elements 
							 * stored in the queue
							 *****************************************************************/
							data.item.animate({
								"left": "-=" + spostamento_sx
							}, 600);
							/***********************************************************
							 * once the animation of all the elements has finished
							 * (deferred object)
							 ***********************************************************/
							data.item.promise().done(function()
							{
								/****************************************************************************
								 * repositioning is calculated based on the location of the last element of 
								 * the list, double check if I have to move the first element
								 ****************************************************************************/
								var position = data.item.last().position(),
									riposizionamento_dx = position.left + data.item.last().outerWidth(true);
								for(k5 = 0; k5 < memo_index.length; k5++)
								{
									if(memo_index[k5] == 0)
									{
										var position = data.item.last().position(),
										riposizionamento_dx = position.left + data.item.last().outerWidth(true);
									}
									data.item.eq(memo_index[k5]).css("left", riposizionamento_dx);
								}
								/*********************************************
								 * re bind buttons "click" event that have 
								 * been detached from the handle to handle 
								 * properly the time of animation
								 ********************************************/
								data.next.on("click",nextHandle);
								data.prev.on("click",prevHandle);
							});
						break;
					}
				break;
				
				/**************************************
				 * list orientation: vertical
				 **************************************/
				case "vertical":
					var spostamento_top = 0,
						viewport_height = 0;
					/************************************************
					 * depending on the type of sliding I calcule 
					 * the displacement and the repositioning of the 
					 * elements of the list
					 ************************************************/	
					switch(data.options.circular)
					{
						/****************************
						 * infinite scrolling: no
						 ***************************/
						case "no":
						default:
							/********************************************************************
							 * displacement calculation based on the number of elements to 
							 * slide in a single step
							 ********************************************************************/
							for (k1 = data.current; k1 < data.current+data.options.scrolling_items; k1++)
							{
								spostamento_top += data.item.eq(k1).outerHeight(true);
							}
							
							/****************************************************************
							 * I edit element current as a function of the number of elements 
							 * to slide in a single step
							 ****************************************************************/
							data.current += data.options.scrolling_items;
							
							/***********************************************************************
							 * calculating the width of the viewport on the basis of the visible 
							 * elements AFTER the sliding animation
							 ***********************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) {
								viewport_height += data.item.eq(k2).outerHeight(true);
							}
							
							/***************************************************
							 * I animate the viewport width
							 ***************************************************/
							data.viewport.animate({
								"height": viewport_height
							}, 600);
							/****************************************
							 * I animate the elements scrolling
							 ****************************************/
							data.item.animate({
								"top": "-=" + spostamento_top
							}, 600);
							/**********************************************************
							 * once the animation of all the elements has finished
							 * (deferred object)
							 **********************************************************/
							data.item.promise().done(function()
							{	/*********************************************
								 * re bind buttons "click" event that has 
								 * been detached from the handle to handle 
								 * properly the time of animation
								 ********************************************/
								data.next.on("click",nextHandle);
								data.prev.on("click",prevHandle);
							});
							
							/****************************************************
							 * control visibility of the scroll buttons on 
							 * the basis of the current element
							 ****************************************************/
							if(data.current > 0)
							{
								data.prev.show();
							}
							
							if (data.current + data.options.visible_items >= data.num_items) 
							{
								data.next.hide();
							}
						break;
						/****************************
						 * infinite scrolling: yes
						 ****************************/
						case "yes":
							var memo = 0, memo_index = [];
							/****************************************************************
							 * displacement calculation based on the number of elements to 
							 * slide in a single step and memorization of items to reposition
							 ****************************************************************/
							for (k1 = data.current; k1 < data.current + data.options.scrolling_items; k1++)
							{
								var k3 = k1;
								/**********************************************
								 * control that the index does not exceed the 
								 * total number of the elements
								 *********************************************/
								if(k1 >= data.num_items)
								{
									k3 = k1 - data.num_items;
								}
								spostamento_top += data.item.eq(k3).outerHeight(true);
								memo_index[memo]= k3;
								memo ++;
							}
							/****************************************************************
							 * edit current element on the basis of the number of elements 
							 * to slide in a single step
							 ****************************************************************/
							data.current += data.options.scrolling_items;
							
							/*************************************************
							 * control that the index does not exceed the 
							 * total number of the elements
							 ************************************************/
							if(data.current >= data.num_items)
							{
								data.current -= data.num_items;
							}
							
							/******************************************************************************
							 * calculating the width of viewport on the basis of the visible elements 
							 * AFTER the scrolling
							 ******************************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) 
							{
								var k4 = k2;
								/**********************************************
								 * control that the index does not exceed the 
							 	 * total number of the elements
								 *********************************************/
								if(k2 >= data.num_items)
								{
									k4 = k2 - data.num_items;
								}
								viewport_height += data.item.eq(k4).outerHeight(true);
							}
							/*************************************************
							 * I animate the viewport width
							 *************************************************/
							data.viewport.animate({
								"height": viewport_height
							});
							
							/****************************************************************
							 * I animate the elements and reposition those previously stored
							 ***************************************************************/
							data.item.animate({
								"top": "-=" + spostamento_top
							});
							/************************************************************
							 * once all the elements' animations has finished
							 * (deferred object)
							 ***********************************************************/
							data.item.promise().done(function()
							{
								/************************************************************************
								 * repositioning is calculated based on the location of the last element 
								 * of the list. Take care to the repositioning of the first element 
								 * that needs to be recalculated AFTER the last was eventually relocated
								 ************************************************************************/
								var position = data.item.last().position(),
									riposizionamento_bottom = position.top + data.item.last().outerHeight(true);
								for(k5 = 0; k5 < memo_index.length; k5++)
								{
									if(memo_index[k5] == 0)
									{
										var position = data.item.last().position(),
										riposizionamento_bottom = position.top + data.item.last().outerHeight(true);
									}
									data.item.eq(memo_index[k5]).css("top", riposizionamento_bottom);
								}
								/*********************************************
								 * re bind buttons "click" event that has 
								 * been detached from the handle to handle 
								 * properly the time of animation
								 ********************************************/
								data.next.on("click",nextHandle);
								data.prev.on("click",prevHandle);
							});
						break;
					}
				break;
			}
			
			/************************************
			 * save the data in als instance and
			 * return als object
			 ***********************************/
			als[id] = data;
			return als;
		},
		/*****************************************************
		 * sliding back function of the list elements
		 * @param {Object} id: instance or ID of the element
		 * that calls the function
		 *****************************************************/
		prev: function(id){
			id = find_instance(id);
			var data = als[id],
				k1 = 0, k2 = 0;
			/***************************************************
			 * depending on the orientation of the list I 
			 * calculate the horizontal or vertical displacement
			 * of the elements
			 ***************************************************/
			switch(data.options.orientation)
			{
				/***************************
				 * horizontal orientation 
				 ***************************/
				case "horizontal":
				default:
					var spostamento_dx = 0,
						viewport_width = 0;
					/****************************************************	
					 * depending on the type of scroll (circular or not) 
					 * I calculate the displacement and the possible 
					 * repositioning of the elements of the list
					 ****************************************************/
					switch(data.options.circular)
					{
						/*****************************
						 * circular scrolling: no
						 *****************************/
						case "no":
						default:
							/***************************************************************
							 * edit the current item index as a function of the elements to 
							 * slide in a single step: edit right away so that you can do 
							 * the next steps "forward"
							 ***************************************************************/
							data.current -= data.options.scrolling_items;
							
							/*******************************************************************
							 * calculating the displacement of the elements according to the 
							 * number of elements to slide in a single step
							 *******************************************************************/
							for (k1 = data.current; k1 < data.current+data.options.scrolling_items; k1++)
							{
								spostamento_dx += data.item.eq(k1).outerWidth(true);
							}
							
							/******************************************************************************
							 * calculation of the viewport width on the basis of the visible elements 
							 * AFTER the scrolling (on the basis of their width)
							 ******************************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) 
							{
								viewport_width += data.item.eq(k2).outerWidth(true);
							}
							/*************************************************
							 * animating the viewport width
							 *************************************************/
							data.viewport.animate({
								"width": viewport_width
							});
							/**********************************
							 * animating elements scrolling
							 **********************************/
							data.item.animate({
								"left": "+=" + spostamento_dx
							}, 600);
							/***********************************************************
							 * once all animations have finished
							 * (deferred object)
							 ***********************************************************/
							data.item.promise().done(function()
							{	/*********************************************
								 * re bind buttons "click" event that have 
								 * been detached from the handle to manage 
								 * properly the time of animation
								 ********************************************/
								data.prev.on("click",prevHandle);
								data.next.on("click",nextHandle);
							});
							
							/**********************************************************
							 * control visibility of the scroll buttons
							 **********************************************************/
							if(data.current <= 0)
							{
								data.prev.hide();
							}
							if (data.current + data.options.visible_items < data.num_items) 
							{
								data.next.show();
							}
						break;
						/*****************************
						 * circular scrolling: yes
						 *****************************/
						case "yes":
							var memo = 0, memo_index = [];
							/***************************************************************
							 * edit the current item index as a function of the elements 
							 * to slide in a single step: edit right away so that we can do 
							 * the next steps "forward"
							 ***************************************************************/
							data.current -= data.options.scrolling_items;
							/**************************************************
							 * check if the current element has not index < 0
							 **************************************************/
							if(data.current < 0)
							{
								data.current += data.num_items;
							}
							/****************************************************************
							 * displacement calculation based on the elements to slide in a 
							 * single step and memorization of the items to reposition
							 ****************************************************************/
							for (k1 = data.current; k1 < data.current + data.options.scrolling_items; k1++)
							{
								var k3 = k1;
								/**********************************************
								 * control that the index does not exceed the 
								 * total number of the elements
								 *********************************************/
								if(k1 >= data.num_items)
								{
									k3 = k1 - data.num_items;
								}
								spostamento_dx += data.item.eq(k3).outerWidth(true);
								memo_index[memo]= k3;
								
								memo ++;
							}
							/******************************************************************************
							 * calculating the width of the viewport on the basis of the 
							 * visible elements AFTER the scrolling
							 ******************************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) 
							{
								var k4 = k2;
								/**********************************************
								 * control that the index does not exceed the 
								 * total number of the elements
								 *********************************************/
								if(k2 >= data.num_items)
								{
									k4 = k2 - data.num_items;
								}
								viewport_width += data.item.eq(k4).outerWidth(true);
							}
							/************************************************************************
							 * repositioning is calculated based on the location of the first element 
							 * of the list. Special care to the repositioning of the last element 
							 * that needs to be recalculated AFTER the first was eventually relocated
							 ************************************************************************/
							var position = data.item.first().position(),
								riposizionamento_sx = position.left - data.wrapper_width;

							for(k5 = 0; k5 < memo_index.length; k5++)
							{
								data.item.eq(memo_index[k5]).css("left", riposizionamento_sx);
								if(memo_index[k5] == 0 && memo_index[k5-1] == data.num_items-1)
								{
									var position = data.item.first().position(),
										riposizionamento_sx = position.left - data.wrapper_width;
									data.item.eq(memo_index[k5-1]).css("left", riposizionamento_sx);
								}
							}
							/************************************************************
							 * timeout of 200ms is necessary to wait before making the 
							 * scrolling animation, otherwise we can not properly manage 
							 * the repositioning of the list elements
							 ************************************************************/
							setTimeout(function() 
							{
								/****************************************
								 * viewport width animation
								 ****************************************/
								data.viewport.animate({
									"width": viewport_width
								});
								/*******************************
								 * list elements animation
								 *******************************/
								data.item.animate({
									"left": "+=" + spostamento_dx
								}, 600);
								/**********************************************************
								 * once all elements animations have finished
								 * (deferred object)
								 **********************************************************/
								data.item.promise().done(function()
								{	/*********************************************
									 * re bind buttons "click" event that have 
									 * been detached from the handle to manage 
									 * properly the time of animation
									 ********************************************/
									data.prev.on("click",prevHandle);
									data.next.on("click",nextHandle);
								});
							}, 200);
						break;
					}	
				break;
				/*************************
				 * vertical orientation
				 ************************/
				case "vertical":
					var spostamento_bottom = 0,
						viewport_height = 0;
					
					switch(data.options.circular)
					{
						/*****************************
						 * circular scrolling: no
						 ****************************/
						case "no":
						default:
							/***************************************************************
							 * edit the current item index as a function of the elements to 
							 * slide in a single step: edit right away so that we can do 
							 * the next steps "forward"
							 ***************************************************************/
							data.current -= data.options.scrolling_items;
							/****************************************************************
							 * displacement calculation based on the elements to slide 
							 * in a single step
							 ****************************************************************/
							for (k1 = data.current; k1 < data.current+data.options.scrolling_items; k1++)
							{
								spostamento_bottom += data.item.eq(k1).outerHeight(true);
							}
							/******************************************************************************
							 * calculating the width of the viewport on the basis of the visible elements 
							 * AFTER the scrolling
							 ******************************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) 
							{
								viewport_height += data.item.eq(k2).outerHeight(true);
							}
							/***********************************************
							 * viewport width animation
							 **********************************************/
							data.viewport.animate({
								"height": viewport_height
							});
							/*****************************************
							 * list elements scrolling animation
							 *****************************************/
							data.item.animate({
								"top": "+=" + spostamento_bottom
							}, 600);
							/**********************************************************
							 * once all elemets animations have finished
							 * (deferred object)
							 **********************************************************/
							data.item.promise().done(function()
							{
								/*********************************************
								 * re bind buttons "click" event that have 
								 * been detached from the handle to manage 
								 * properly the time of animation
								 ********************************************/
								data.prev.on("click",prevHandle);
								data.next.on("click",nextHandle);
							});
							/***********************************************************
							 * management of visibility of forward and backward buttons
							 **********************************************************/
							if(data.current <= 0)
							{
								data.prev.hide();
							}
							if (data.current + data.options.visible_items < data.num_items) 
							{
								data.next.show();
							}
						break;
						case "yes":
						/*****************************
						 * circular scrolling: yes
						 *****************************/
							var memo = 0, memo_index = [];
							/***************************************************************
							 * edit the current item index as a function of the elements to 
							 * slide in a single step: edit right away so that we can do 
							 * the next steps "forward"
							 ***************************************************************/
							data.current -= data.options.scrolling_items;
							/*********************************************************
							 * control that the current element has not index < 0
							 *********************************************************/
							if(data.current < 0)
							{
								data.current += data.num_items;
							}
							/********************************************************************
							 * displacement calculation based on the elements to slide in a 
							 * single step and memorization of those that have to be repositioned
							 * later
							 ********************************************************************/
							for (k1 = data.current; k1 < data.current + data.options.scrolling_items; k1++)
							{
								var k3 = k1;
								/***********************************************
								 * control that the index does not exceed the 
								 * total number of the elements
								 ***********************************************/
								if(k1 >= data.num_items)
								{
									k3 = k1 - data.num_items;
								}
								spostamento_bottom += data.item.eq(k3).outerHeight(true);
								memo_index[memo]= k3;
								
								memo ++;
							}
							/******************************************************************************
							 * calculating the width of the viewport on the basis of the visible elements 
							 * AFTER the scrolling
							 ******************************************************************************/
							for (k2 = data.current; k2 < data.current + data.options.visible_items; k2++) 
							{
								var k4 = k2;
								/***********************************************
								 * control that the index does not exceed the 
								 * total number of the elements
								 ***********************************************/
								if(k2 >= data.num_items)
								{
									k4 = k2 - data.num_items;
								}
								viewport_height += data.item.eq(k4).outerHeight(true);
							}
							/************************************************************************
							 * repositioning is calculated based on the location of the first element 
							 * of the list. Special care to the repositioning of the last element 
							 * that needs to be recalculated AFTER the first was eventually relocated
							 ************************************************************************/
							var position = data.item.first().position(),
								riposizionamento_top = position.top - data.wrapper_height;
							for(k5 = 0; k5 < memo_index.length; k5++)
							{
								data.item.eq(memo_index[k5]).css("top", riposizionamento_top);
								if(memo_index[k5] == 0 && memo_index[k5-1] == data.num_items-1)
								{
									var position = data.item.first().position(),
										riposizionamento_top = position.top - data.wrapper_height;
									data.item.eq(memo_index[k5-1]).css("top", riposizionamento_top);	
								}
							}
							/************************************************************
							 * timeout of 200ms is necessary to wait before making the 
							 * scrolling animation, otherwise we can not properly manage 
							 * the repositioning of the list elements
							 ************************************************************/
							setTimeout(function()
							{
								/*********************************************
								 * viewport width animation
								 *********************************************/
								data.viewport.animate({
									"height": viewport_height
								}, 600);
								/************************************
								 * list elements scrolling animation
								 ***********************************/
								data.item.animate({
									"top": "+=" + spostamento_bottom
								}, 600);
								/***********************************************************
								 * once all elements animations have finished
								 * (deferred object)
								 **********************************************************/
								data.item.promise().done(function()
								{
									/*********************************************
									 * re bind buttons "click" event that have 
									 * been detached from the handle to manage 
									 * properly the time of animation
									 ********************************************/
									data.prev.on("click",prevHandle);
									data.next.on("click",nextHandle);
								});
							}, 200);
						break;
					}
				break;
			}
			/************************************
			 * saving als instance data and
			 * returning als object
			 ***********************************/
			als[id] = data;
			return als;
		},
		/**************************************************************
		 * start function for automatic scrolling
		 * @param {Object} id: instance or ID of the element that has
		 * called the function
		 **************************************************************/ 
		start: function(id){
			id = find_instance(id);
			var data = als[id];
			/**********************************************************
			 * stopping any previous automatic scrolling
			 *********************************************************/
			if(data.timer != 0)
			{
				clearInterval(data.timer);
			}
			/************************************
			 * depending on the direction you 
			 * choose automatic scrolling begins
			 ***********************************/
			switch(data.options.direction)
			{
				/************************************************
				 * if left or up (that means "forward")
				 ************************************************/
				case "left":
				case "up":
				default:
					/************************************
					 * detachment from the handler buttons 
					 * and the animation forward start 
					 * (next function)
					 ************************************/
					data.timer = setInterval(function(){
						data.next.off();
						data.prev.off();
						$.fn.als('next',id);
						},data.options.interval);
				break;
				/***************************************************
				 * if right or down (that means "backward")
				 ***************************************************/
				case "right":
				case "down":
					/************************************
					 * detachment from the handler buttons 
					 * and the animation forward start 
					 * (prev function)
					 ************************************/
					data.timer = setInterval(function(){
						data.prev.off();
						data.next.off();
						$.fn.als('prev',id);
						},data.options.interval);
				break;
			}
			/************************************
			 * saving als instance data and
			 * returning als object
			 ***********************************/
			als[id] = data;
			return als;
		},
		/**************************************************************
		 * stop function for automatic scrolling
		 * @param {Object} id: instance or ID of the element that
		 * called the function
		 **************************************************************/ 
		stop: function(id)
		{
			id = find_instance(id);  
			var data = als[id];
			/********************************
			 * stop autoscrolling
			 *******************************/
			clearInterval(data.timer);
			/************************************
			 * saving data into als instance
			 * and returning als object
			 ***********************************/
			als[id] = data;
			return als;
		},
		/*****************************
		 * function that destroys als
		 *****************************/
		destroy : function(){
         	$(window).unbind('.als');
            instance = 0;
		},
	}
	
	/**************************
	 **************************
	 * service functions
	 ************************** 
	 **************************/
	
	/********************************************************************
	 * function to find the current plugin instance
	 * @param {Object} id: plugin instance od ID of the element that
	 * called the plugin
	 ********************************************************************/
	function find_instance(id)
	{
		if(typeof(id) === "string")
		{
			var position = id.indexOf("_");	
			if(position != -1)
			{
				id = id.substr(position+1);  
			}
		}
		return id
	}
	
	/****************************************************
	 * function that manages "click" action on next button
	 * @param {Object} e event
	 ***************************************************/
	function nextHandle(e)
	{
		e.preventDefault();
		var id = find_instance($(this).attr("data-id")),
			data = als[id];
		/*********************************************
		 * unbinding next and prev buttons so that
		 * they don't interfere with current animation
		 ********************************************/	
		$(this).off();
		data.prev.off();
		/********************************************
		 * calling next function on this instance
		 ********************************************/
		$.fn.als('next',id);
	}
	
	/******************************************************
	 * function that manages "click" action on prev button
	 * @param {Object} e event
	 ******************************************************/
	function prevHandle(e)
	{
		e.preventDefault();
		var id = find_instance($(this).attr("data-id")),
			data = als[id];
		/***********************************************
		 * unbinding next and prev buttons so that
		 * they don't interfere with current animation
		 **********************************************/	
		$(this).off();
		data.next.off();
		/*********************************************
		 * calling prev function on this instance
		 *********************************************/
		$.fn.als('prev',id);
	}
	
	/********************************************************************
	 * function that generates the plugin and instantiates its methods
	 * @param {Object} method
	 *******************************************************************/
	$.fn.als = function( method ) 
	{
	    if ( methods[method] ) 
		{
	    	return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } 
		else if ( typeof method === 'object' || ! method ) 
		{
	    	return methods.init.apply( this, arguments );
	    } 
		else 
		{
	    	$.error( 'Method ' +  method + ' does not exist on jQuery.als' );
	    }
  	};
		
})(jQuery);
