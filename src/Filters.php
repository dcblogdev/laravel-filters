<?php

namespace Daveismyname\Filters;

use Daveismyname\Filters\Models\Filter;

class Filters
{
    public function get($module = null) 
    {
        $query = Filter::where('user_id', auth()->id());
        if ($module != null) {
            $query->where('module', $module);
        }

        return $query->get();
    }

    public function run($module, $moduleurl)
    {
        //if filter savefilter has been clicked
        if (request()->exists('savefilter')) {
            $this->storeFilter($module, $moduleurl);
        }

        //if a saved filter has been selected
        if (request()->exists('savedfilter')) {
            $this->applyFilter($module, $moduleurl);
        }

        //if a saved filter has been selected
        if (request()->exists('removefilter')) {
            $this->deleteFilter($moduleurl);
        }
    }

    protected function storeFilter($module, $moduleurl)
    {
        //if filter title is not empty
        if (request('filterTitle') !='') {
            $data = request()->except(['savedfilter', 'savefilter']);

            //set empty
            $url = null;

            //loop over each key of array and convert into &item=value
            $url .= '?' . $this->buildQuery($data);

            //find out how many filters exist matching the user and the title
            $filterCount = Filter::where('user_id', auth()->id())->where('title', request('filterTitle'))->count();

            //if there is no match insert
            if ($filterCount == 0) {
                Filter::create([
                    'title' => request('filterTitle'),
                    'user_id' => auth()->id(),
                    'data' => $url,
                    'module' => $module
                ]);

                //redirect back and apply the requested filter
                redirect()->to("$moduleurl/$url")->send();
            }
        }
    }

    protected function applyFilter($module, $moduleurl)
    {
        //find out how many filters exist matching the user and the title
        $filter = Filter::find(request('savedfilter'));

        if ($filter != null) {

            //redirect back and apply the requested filter
            redirect()->to("$moduleurl/$filter->data")->send();
        }
    }

    protected function deleteFilter($moduleurl)
    {
        //find the filter
        $filter = Filter::find(request('removefilter'));

        if ($filter != null) {

            //delete the filter
            $filter->delete();

            //redirect back
            return redirect()->to($moduleurl)->send();
        }
    }

    /**
     * @param array $data
     * @return string
     */
    public function buildQuery($data)
    {
        return http_build_query($data);
    }
}
