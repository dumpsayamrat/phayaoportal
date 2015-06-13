<?php
/**
 * Created by PhpStorm.
 * User: 56023_000
 * Date: 3/30/2015
 * Time: 21:23
 */
/////////////////////////////////เหลือทำ post ajax in AdminController

?>
@extends('admin.layout')

@section('content')
    <style>
        .ui.form select{
            width: 80%;
            display: -webkit-inline-box;
        }
        .ui.form .tag{
            margin-top: 5px;
        }
        .ui.header{
            font-weight: 0;
        }
        .ui.header:not(h1):not(h2):not(h3):not(h4):not(h5):not(h6) {
            font-size: 1.0em;
        }
    </style>
    {{-- <div class="ui page grid">--}}

                    <h1><i class="big settings teal icon"></i> เพิ่มจุดเชื่อมต่อภายนอก</h1>

                    {{ Form::open(array('url' => '/admin/link/create?form=form_main','class' => 'ui warning form teal segment','files'=>true)) }}
                        @if(!$errors->isEmpty())

                        <div class="ui red message">
                            <div class="header">{{ HTML::ul($errors->all()) }}</div>
                        </div>
                        @elseif(Session::has('message'))
                            <div class="ui info message">
                                <div class="header">{{ Session::get('message') }}</div>
                            </div>
                        @endif
                        <div class="two fields">
                            <div class="required field">
                                {{ Form::label('name','ชื่อจุดเชื่อมต่อภายนอก') }}
                                {{ Form::text('name',null,['placeholder'=>'ชื่อจุดเชื่อมต่อภายนอก']) }}
                            </div>
                            <div class="required field">
                                {{ Form::label('link','ที่อยู่จุดเชื่อมต่อภายนอก') }}
                                {{ Form::text('link',null,['placeholder'=>'Link address']) }}
                            </div>
                        </div>


                        <div class="field">
                            {{ Form::label('usercategories','หมวดหมู่ผู้ใช้') }}
                            <select class="ui" name="usercategories" id="usercategories">
                                <option value=""></option>
                            </select>
                            <a id="add_uc" class="ui tag blue label">จัดการ</a>
                        </div>

                        <div class="field">
                            {{ Form::label('majorcategories','หมวดหมู่หลัก') }}
                            <select class="ui" name="majorcategories" id="majorcategories">
                                <option value=""></option>

                            </select>
                            <a id="add_mjc" class="ui tag blue label">จัดการ</a>
                        </div>

                        <div class="field">
                            {{ Form::label('middlecategories','หมวดหมู่รอง') }}
                            <select class="ui" name="middlecategories" id="middlecategories">
                                <option value=""></option>
                            </select>
                            <a id="add_mdc" class="ui tag blue label">จัดการ</a>
                        </div>

                        <div class="field">
                            {{ Form::label('descript','คำอธิบาย') }}
                            {{ Form::textarea('descript') }}
                        </div>

                        <div class="required field">
                            {{ Form::label('img','รูปภาพ') }}
                            {{ Form::file('img') }}
                        </div>
                        {{ Form::submit('เพิ่ม',array('class'=>'ui submit teal button')) }}

                    {{ Form::close() }}
            {{--model add usercategory--}}
                <div class="ui small modal" id="modal_uc">
                    <i class="close icon"></i>
                    <div class="header">
                        <i class="settings icon"></i>
                        จัดการหมวดหมู่ผู้ใช้
                    </div>
                    <div class="content">
                        <div class="ui green dividing header">
                            <i class="settings icon"></i>
                            <div class="content">
                                เพิ่มหมวดหมู่

                            </div>

                            {{ Form::open(array('data-remote','class'=>'ui form green segment','id'=>'form_uc')) }}
                            <div class="field">
                                {{ Form::label('name','ชื่อ :') }}
                                {{ Form::text('name',null,['placeholder'=>'กรอกชื่อหมวดหมู่'])}}
                            </div>

                            {{ Form::submit('เพิ่ม',['class'=>'ui green button']) }}
                            <div id="load_uc" class="ui dimmer">
                                <div class="ui small text loader">Loading</div>
                            </div>
                            {{ Form::close() }}
                            <div class="ui success hidden message">
                                <p></p>
                            </div>
                        </div>
                        {{--update uc--}}
                        <div class="ui red dividing header">
                            <i class="settings icon"></i>
                            <div class="content">
                                แก้ไขหมวดหมู่
                            </div>
                            {{ Form::label('uc','เลือกหมวดหมู่ที่ต้องการแก้ไข : ') }}
                            <select class="ui" name="uc" id="uc">
                                <option value=""></option>
                            </select>
                            {{ Form::open(array('data-remote','class'=>'ui form red segment','id'=>'up_form_uc')) }}
                                 {{ Form::hidden('target','usercategory') }}
                                 {{ Form::hidden('id',null) }}
                                <div class="field">
                                    {{ Form::label('name','ชื่อ :') }}
                                    {{ Form::text('name',null,['style'=>'  width: 85%;'])}}
                                    <a id="del_form_uc" class="ui red button">ลบ</a>
                                </div>
                            {{ Form::submit('บันทึก',['class'=>'ui green button']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="actions">
                        <div class="ui black button">
                            ออก
                        </div>
                        {{--<div class="ui button">
                            <i class="checkmark icon"></i>
                        </div>--}}

                    </div>
                </div>
                {{--model add majorcategory--}}
                <div class="ui small modal" id="modal_mjc">
                    <i class="close icon"></i>
                    <div class="header">
                        <i class="settings icon"></i>
                        จัดการหมวดหมู่หลัก
                    </div>
                    <div class="content">
                        <div class="ui green dividing header">
                            <i class="settings icon"></i>
                            <div class="content">
                                เพิ่มหมวดหมู่

                            </div>
                        {{ Form::open(array('data-remote','class'=>'ui form green segment','id'=>'form_mjc')) }}

                        <div class="field">
                            {{ Form::label('name','ชื่อ :') }}
                            {{ Form::text('name',null,['placeholder'=>'กรอกชื่อหมวดหมู่'])}}
                        </div>

                        {{ Form::submit('เพิ่ม',['class'=>'ui green button']) }}

                        <div id="load_mjc" class="ui dimmer">
                            <div class="ui small text loader">Loading</div>
                        </div>
                        {{ Form::close() }}
                            </div>
                        <div class="ui success hidden message">
                            <p></p>
                        </div>
                        <div class="ui red dividing header">
                            <i class="settings icon"></i>
                            <div class="content">
                                แก้ไขหมวดหมู่
                            </div>
                            {{ Form::label('mjc','เลือกหมวดหมู่ที่ต้องการแก้ไข : ') }}
                            <select class="ui" name="mjc" id="mjc">
                                <option value=""></option>

                            </select>
                            {{ Form::open(array('data-remote','class'=>'ui form red segment','id'=>'up_form_mjc')) }}
                            {{ Form::hidden('target','majorcategory') }}
                            {{ Form::hidden('id',null) }}
                            <div class="field">
                                {{ Form::label('user_categories_id','เลือกหมวดหมู่ผู้ใช้ : ') }}
                                <select class="ui" name="user_categories_id" id="user_categories_id">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="field">
                                {{ Form::label('name','ชื่อ :') }}
                                {{ Form::text('name',null,['style'=>'  width: 85%;'])}}
                                <a id="del_form_mjc" class="ui red button">ลบ</a>
                            </div>
                            {{ Form::submit('บันทึก',['class'=>'ui green button']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="actions">
                        <div class="ui black button">
                            ออก
                        </div>
                        {{--<div class="ui button">
                            <i class="checkmark icon"></i>
                        </div>--}}

                    </div>
                </div>
                {{--model add middle--}}
                <div class="ui small modal" id="modal_mdc">
                    <i class="close icon"></i>
                    <div class="header">
                        <i class="settings icon"></i>
                        จัดการหมวดหมู่รอง
                    </div>
                    <div class="content">
                        <div class="ui green dividing header">
                            <i class="settings icon"></i>
                            <div class="content">
                                เพิ่มหมวดหมู่

                            </div>
                        {{ Form::open(array('data-remote','class'=>'ui form green segment','id'=>'form_mdc')) }}
                        <div class="field">

                            {{ Form::label('name','ชื่อ :') }}
                            {{ Form::text('name',null,['placeholder'=>'กรอกชื่อหมวดหมู่'])}}
                        </div>

                        {{ Form::submit('เพิ่ม',['class'=>'ui green button']) }}
                        <div id="load_mdc" class="ui dimmer">
                            <div class="ui small text loader">Loading</div>
                        </div>
                        {{ Form::close() }}
                            </div>
                        <div class="ui success hidden message">
                            <p></p>
                        </div>
                        <div class="ui red dividing header">
                            <i class="settings icon"></i>
                            <div class="content">
                                แก้ไขหมวดหมู่
                            </div>
                            {{ Form::label('mdc','เลือกหมวดหมู่ที่ต้องการแก้ไข : ') }}
                            <select class="ui" name="mdc" id="mdc">
                                <option value=""></option>
                            </select>
                            {{ Form::open(array('data-remote','class'=>'ui form red segment','id'=>'up_form_mdc')) }}
                            {{ Form::hidden('target','middlecategory') }}
                            {{ Form::hidden('id',null) }}
                            <div class="field">
                                {{ Form::label('major_categories_id','เลือกหมวดหมู่ผู้ใช้ : ') }}
                                <select class="ui" name="major_categories_id" id="major_categories_id">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="field">
                                {{ Form::label('name','ชื่อ :') }}
                                {{ Form::text('name',null,['style'=>'  width: 85%;'])}}
                                <a id="del_form_mdc" class="ui red button">ลบ</a>
                            </div>
                            {{ Form::submit('บันทึก',['class'=>'ui green button']) }}

                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="actions">
                        <div class="ui black button">
                            ออก
                        </div>
                        {{--<div class="ui button">
                            <i class="checkmark icon"></i>
                        </div>--}}

                    </div>
                </div>

    {{--</div>--}}
@stop
@section('javascript')
    <script>
        runUc('#usercategories');
    </script>
    @stop