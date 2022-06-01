<h1 align="center">Ads Store Documentation</h1>

# 1.Install
# 2.Components

## I. Livewire
### x-input
   1. Text/Number
   ```html
   <x-input class="classes" :type='text/number' :placeholder='$placeholder' ></x-input>
   ```
   2. Select
   ```html
   <x-input type="select" wire:model='wire_model' class="classes" :options="$select_options[]" :selected="$selected_option"></x-input>
   ```
`:options => type array accepted ` <br>
`:selected => variable accepted OR just plain text for a placeholder (optional) `

   3. Toggle
   ```html
   <x-input type="toggle" text="text" id="toggle" model="model" class="classes" color="color"></x-input>
   ```
`text => text to be displayed to the left (optional) ` <br>
`class => classes will only be applied to the text (optional)` <br>
`model => name of the variable used for wire:model (string)` <br>
`color => color for the toggle, currently only 'blue' is supported (optional)(default: black)` <br>

   4. Datepicker
   ```html
   <x-input type="datepicker" wire:model.lazy='date' class="classes from tailwind" id="datepicker" placeholder='placeholder' x-init="javascript purposes"></x-input>
   ```

   5. Input with tooltip to the right
   ```html
   <x-input type="right-tooltip" tooltip="text" wire:model='wire_model'></x-input>
   ```
`tooltip => text to be displayed to the right`

## II. Tailwind
   1. Button

      1. Primary
      ![screenshot-adstore test-2022 05 05-12_39_42](https://user-images.githubusercontent.com/45566836/166898421-762b4fde-c522-4b24-94bb-7fe38312d118.png)
         ```html
         <button class="button-primary">Primary</button>
         <button class="button-primary-lg">Primary [lg]</button>
         <button class="button-primary-md">Primary [md]</button>
         <button class="button-primary-sm">Primary [sm]</button>
         ```
      2. Secondary
         ```html
         <button class="button-secondary">Secondary</button>
         <button class="button-secondary-lg">Secondary [lg]</button>
         <button class="button-secondary-md">Secondary [md]</button>
         <button class="button-secondary-sm">Secondary [sm]</button>
         ```
      3. Info
         ```html
         <button class="button-info">Info</button>
         <button class="button-info-lg">Info [lg]</button>
         <button class="button-info-md">Info [md]</button>
         <button class="button-info-sm">Info [sm]</button>
         ```
      4. Danger
         ```html
         <button class="button-danger">Danger</button>
         <button class="button-danger-lg">Danger [lg]</button>
         <button class="button-danger-md">Danger [md]</button>
         <button class="button-danger-sm">Danger [sm]</button>
         ```
      5. Dark
         ```html
         <button class="button-dark">Dark</button>
         <button class="button-dark-lg">Dark [lg]</button>
         <button class="button-dark-md">Dark [md]</button>
         <button class="button-dark-sm">Dark [sm]</button>
         ```
      6. Empty
         ```html
         <button class="button-empty">Empty</button>
         <button class="button-empty-lg">Empty [lg]</button>
         <button class="button-empty-md">Empty [md]</button>
         <button class="button-empty-sm">Empty [sm]</button>
         ```
   2. Link
      ```html
      <button class="link-primary">Primary</button>
      <button class="link-secondary">Secondary</button>
      ```
      
   3. DataTable
      1. DataTables Classes
         
      In order to create your first datatable class run:
      ```php
      php artisan make:datatable [Datatable class name] [Model Name]
      ```
      
         You'll get a structure like this:
      ```php
         <?php

         namespace App\Datatables

         use Updivision\Datatable\Core\Abstracts\DataTable;
         use App\Models\{{ model }};

         /**
          * Class {{ class }}
          *
          * @package App\DataTables
          */
         class {{ class }} extends DataTable
         {
             /** @var string */
             public string $model = {{ model }}::class;


             /** @var string */
             public string $sortDir = 'desc'; // 'desc' | 'asc'

             /** @var string */
             public string $sortBy = 'created_at'; // Column Name

             /** @var bool */
             public bool $hasQueryStrings = true; // Display Search, Filters, Sorting and Pagination properties in url

             /** @var bool */
             public bool $paginate = true; // true | false

             /** @var int */
             public int $pageLength = 10; // 10 | 25 | 50 | 100

             /** @var bool */
             public bool $enableSearch = true; // Enable Search

             /** @var bool */
             public bool $enableSorting = true; // Enable Sorting

             /** @var bool */
             public bool $enableFilters = true; // Enable Filters

             /** @var bool */
             public bool $enableResetFilters = true; // Enable Reset Filters Button,

             /**
              * @return void
              */
             public function init()
             {
                 // Set your columns
                 $this->setColumns([]);

                 // Set your filters
                 $this->setFilters([]);

                 // Set your actions
                 $this->setActions([]);
             }

             /**
              * @return mixed

              */
             public function setQuery(): mixed
             {
                 return new $this->model();
             }
         }
      ```

      3. Columns
      ```php
         // Usage
         
         // > Create a column through Facade
         
         use \Updivision\Datatable\Core\Facades\Column;
         
         Column::ID($name = 'id', $attribute = 'id', $label = 'ID') // Returns IDColumn::class
         Column::text($name, $attribute = null $label = null) // Returns TextColumn::class
         Column::email($name, $attribute = null, $label = null) // Returns EmailColumn::class
         Column::boolean($name, $attribute = null, $label = null) // Returns BooleanColumn::class
         Column::datetime($name, $attribute = null, $label = null) // Returns DatetimeColumn::class
         Column::date($name, $attribute = null, $label = null) // Returns DateColumn::class
         Column::time($name, $attribute = null, $label = null) // Returns TimeColumn::class
         Column::multiple($name, $attribute = null, $label = null) // Returns MultipleColumn::class

         // > Available Setters for all types of columns         
         -> setAttribute(string $attribute)
         -> setLabel(string $label)
         -> setSearchable(bool $searchable)
         -> setSortable(bool $sortable)
         -> setFilterable(bool $filterable)
         -> setRenderCallback(Closure $renderCallback, bool $skipCustomFormatting)
         
         // > BooleanColumn
         -> setFalseString(string $false_string = 'No')
         -> setTrueString(string $true_string = 'Yes')
         
         // > MultipleColumn
         -> setSeparator(string $separator = ', ')
         
         // > DatetimeColumn, TimeColumn, DateColumn
         -> setFormat(string $format)
      ```

      5. Filters
      ```php
         // Usage
         
         // > Create a filter through Facade
         
         use \Updivision\Datatable\Core\Facades\Filter;
         
         Filter::id($name = 'id', $attribute = 'id', $label = 'ID') // Returns IDColumnFilter::class
         Filter::text($name, $attribute = null $label = null) // Returns TextColumnFilter::class
         Filter::email($name, $attribute = null, $label = null) // Returns EmailColumnFilter::class
         Filter::boolean($name, $attribute = null, $label = null) // Returns BooleanColumnFilter::class
         Filter::datetime($name, $attribute = null, $label = null) // Returns DatetimeColumnFilter::class
         Filter::date($name, $attribute = null, $label = null) // Returns DateColumnFilter::class
         Filter::time($name, $attribute = null, $label = null) // Returns TimeColumnFilter::class
         Filter::multiple($name, $attribute = null, $label = null) // Returns MultipleColumnFilter::class

         // > Available Setters for all types of filters   
         -> setPlaceholder($placeholder)
         -> setQueryCallback(Closure $queryCallback)
         
         // > MultipleColumnFilter
         -> setOptions(string $options)
         // >>>>> $options formats <<<<<
         // First Format
         // [
         //    'your_value' => 'your_label',
         //    ...
         // ]
         // Second Format (Array)
         // [
         //    [
         //       'label' => 'your_label',
         //       'value' => 'your_value',
         //    ],
         //    ...
         // ]
         // Third Format (Objects)
         // [
         //    (object) [
         //       'label' => 'your_label',
         //       'value' => 'your_value',
         //    ],
         //    ...
         // ]
         // function () {
         //    return [
         //       You can use here all 3 formats
         //    ];
         // }
         -> setOptionsNullValue(string $nullValueLabel)
         // Adds a null value at the start of options
         
         // > BooleanColumnFilter
         -> setFalseString(string $false_string = 'No')
         -> setTrueString(string $true_string = 'Yes')
         
         // > DatetimeColumnFilter, TimeColumnFilter, DateColumnFilter
         -> setFormat(string $format)
      ```

      6. Actions
      ```php
         // Usage
         
         // > Create action through Facade
         
         use \Updivision\Datatable\Core\Facades\Action;
         
         Action::link(string $name) // Returns LinkAction::class
         Action::edit(string $route, array $routeParameters = [], string $name = null) // Returns EditAction::class
         Action::delete(string $name = null) // Returns DeleteAction::class

         // > Available Setters for all types of actions
         -> setText(string $text)
         -> setAttributes(array $attributes)
         -> setRenderCallback(Closure $renderCallback)
         
         // EditAction
         -> setRoute(string $route, array $routeParameters = [])
         // >>>>> $route should be the name of existing route in /routes
         // >>>>> $routeParameters formats <<<<<
         // Format
         // [
         //    'route_parameter' => 'entity_attribute',
         //    'user' => 'id',
         //    ...
         // ]
      ```

      7. Livewire
         1. Page
      ```php
        LivewirePage.php
        public function render()
        {
             $datatable = new {{ datatable class }}();

             return view('livewire.crud.resource.livewire-page', [
                 'datatable' => $datatable,
                 'title' => 'Livewire Page',
             ]);
         }
          
         livewire-page.blade.php
         
         // Search
         <livewire:datatable::search
            :datatable-class="$datatable::class"
            :title="$title . ' Search'" // string ( optional | default: 'Search' )
            :placeholder="'Enter search term'" // string ( optional | default: 'Enter search term' )
            :show-reset-button="true" // bool ( optional | default: true )
         />

         // Filters
         <livewire:datatable::filters :datatable-class="$datatable::class" />
         
         // Remove Filters Button
         <livewire:datatable::filters.remove :datatable-class="$datatable::class" />
          
         // DataTable 
         <livewire:datatable::datatable :datatable-class="$datatable::class" />
       ```
