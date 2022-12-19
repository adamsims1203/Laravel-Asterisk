<?php

class CallerIDController extends BaseController {

	public function getIndex()
	{
        $caller_ids = DB::table('caller_ids')->orderBy('id','desc')->get();

        return View::make('settings.caller_id')
            ->with(['caller_ids' => $caller_ids]);
	}

    public function postCreate()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'area_code' => 'required|numeric|min:3',
            'prefix'    => 'required|numeric|min:3',
            'number'    => 'required|numeric|min:4',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('/system/caller_id')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            // create session in database
            $area_code = Input::get('area_code');
            $prefix = Input::get('prefix');
            $number = Input::get('number');

            $caller_id = DB::table('caller_ids')->insertGetId(
                array(
                    'area_code' => $area_code,
                    'prefix' => $prefix,
                    'number' => $number,
                    'full_number' => $area_code.$prefix.$number,
                    'status' => 'Not Used',
                    'created_by_id' => Auth::user()->id
                )
            );
        }

        Session::flash('message', 'Caller ID was added.');
        return Redirect::to('/settings/caller_id');

    }

    public function edit($id)
    {
        $caller_id = CallerID::find($id);

        return View::make('settings.caller_id_edit')
            ->with(['caller_id' => $caller_id]);
    }

    public function update($id)
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'area_code' => 'required|numeric|min:3',
            'prefix'    => 'required|numeric|min:3',
            'number'    => 'required|numeric|min:4',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('/system/caller_id/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            // create session in database
            $area_code = Input::get('area_code');
            $prefix = Input::get('prefix');
            $number = Input::get('number');

            $caller_id = CallerID::find($id);
            $caller_id->update(
                array(
                    'area_code' => $area_code,
                    'prefix' => $prefix,
                    'number' => $number,
                    'full_number' => $area_code . $prefix . $number,
                    'status' => 'Not Used',
                    'updated_by_id' => Auth::user()->id
                )
            );
        }

        Session::flash('message', 'Caller ID was updated.');
        return Redirect::to('/settings/caller_id');

    }

    public function delete($id)
    {
        $caller_id = CallerID::find($id);
        $caller_id->delete();

        Session::flash('message', 'Caller ID was deleted.');
        return Redirect::to('/settings/caller_id');
    }


}
