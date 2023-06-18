@extends('layouts.app')

@section('content')

<div class="mb-6">
  <div class="flex justify-between items-baseline">
    <h2 class="text-2xl font-bold">Score board</h2>
    <span class="text-2xl font-semibold text-green-500">50%</span>
  </div>
  <div class="bg-gray-300 h-4 mt-2 w-full rounded">
    <div class="bg-green-500 h-full w-1/2 rounded-l"></div>
  </div>
</div>
<table class="table-auto border-collapse w-full">
  <thead>
    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
      <th class="px-4 py-2 bg-gray-200">Name</th>
      <th class="px-4 py-2 bg-gray-200">Description</th>
      <th class="px-4 py-2 bg-gray-200">Status</th>
    </tr>
  </thead>
  <tbody class="text-sm font-normal text-gray-700">
    <tr class="hover:bg-gray-100 px-4 py-2">
      <td class="px-4 py-4">SQL Injection</td>
      <td class="px-4 py-4 break-all max-w-[300px]">
        Attackers inject SQL code, manipulating data unauthorizedly.
      </td>
      <td class="px-4 py-4">
        <span class="inline-flex items-center text-sm font-semibold text-white px-3 py-1 rounded-full bg-green-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L7 11.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          solved
        </span>
      </td>
    </tr>
    <tr class="hover:bg-gray-100 px-4 py-2">
      <td class="px-4 py-4">XSS</td>
      <td class="px-4 py-4 break-all max-w-[300px]">
        XSS stands for Cross-Site Scripting, a type of security
        vulnerability that allows attackers to inject malicious scripts
        into webpages viewed by other users, potentially stealing
        sensitive information or hijacking user sessions.
      </td>
      <td class="px-4 py-4">
        <span class="inline-flex items-center text-sm font-semibold text-white px-3 py-1 rounded-full bg-red-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M5.293 5.293a1 1 0 011.414 0L10 8.586l3.293-3.293a1 1 0 011.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          unsolved
        </span>
      </td>
    </tr>
    <tr class="hover:bg-gray-100 px-4 py-2">
      <td class="px-4 py-4">CSRF</td>
      <td class="px-4 py-4 break-all max-w-[300px]">
        CSRF stands for Cross-Site Request Forgery, a type of web security
        vulnerability that tricks users into performing unwanted actions
        on a website they're authenticated to, without their knowledge or
        consent.
      </td>
      <td class="px-4 py-4">
        <span class="inline-flex items-center text-sm font-semibold text-white px-3 py-1 rounded-full bg-red-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M5.293 5.293a1 1 0 011.414 0L10 8.586l3.293-3.293a1 1 0 011.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          unsolved
        </span>
      </td>
    </tr>
    <tr class="hover:bg-gray-100 px-4 py-2">
      <td class="px-4 py-4">Login Admin</td>
      <td class="px-4 py-4 break-all max-w-[300px]">
        Log in with the administrator's user account.
      </td>
      <td class="px-4 py-4">
        <span class="inline-flex items-center text-sm font-semibold text-white px-3 py-1 rounded-full bg-green-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L7 11.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          solved
        </span>
      </td>
    </tr>
  </tbody>
</table>

@endsection