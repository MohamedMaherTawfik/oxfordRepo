<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'message' => 'required|string|max:1000',
            ]);

            // Webhook URL
            $webhookUrl = 'https://n8n.srv1098985.hstgr.cloud/webhook-test/34d5d240-d48b-4c74-8e40-d5acd3460785';
            
            // Prepare query parameters for GET request
            $queryParams = [
                'message' => $request->message,
            ];
            
            // Log request for debugging
            \Log::info('Chat webhook request', [
                'url' => $webhookUrl,
                'method' => 'GET',
                'query_params' => $queryParams,
            ]);
            
            // Send message to webhook with GET
            $response = Http::timeout(30)
                ->withHeaders([
                    'Accept' => 'application/json',
                ])
                ->withoutVerifying() // Disable SSL verification if needed
                ->get($webhookUrl, $queryParams);

            // Log response for debugging
            \Log::info('Chat webhook response', [
                'status' => $response->status(),
                'headers' => $response->headers(),
                'body' => $response->body(),
            ]);

            // Check if request was successful (200-299)
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Log full response for debugging
                \Log::info('Chat webhook full response data', [
                    'response_data' => $responseData,
                    'response_type' => gettype($responseData),
                ]);
                
                // Handle different response formats from webhook
                // Priority: output > reply > response > message > text > content > data > answer
                $reply = null;
                
                if (is_array($responseData)) {
                    // Check for output first (as requested)
                    if (isset($responseData['output'])) {
                        $output = $responseData['output'];
                        // If output is an array, try to extract text or use JSON
                        if (is_array($output)) {
                            $reply = $output['text'] 
                                ?? $output['message'] 
                                ?? $output['content']
                                ?? $output['response']
                                ?? json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                        } else {
                            $reply = $output;
                        }
                    } else {
                        // Fallback to other keys
                        $reply = $responseData['reply'] 
                            ?? $responseData['response'] 
                            ?? $responseData['message'] 
                            ?? $responseData['text']
                            ?? $responseData['content']
                            ?? $responseData['data']
                            ?? $responseData['answer']
                            ?? null;
                    }
                } elseif (is_string($responseData)) {
                    $reply = $responseData;
                }
                
                // If no reply found, use the whole response
                if ($reply === null || $reply === '') {
                    if (is_array($responseData) && !empty($responseData)) {
                        // Try to get first value if it's an array
                        $firstValue = reset($responseData);
                        if (is_string($firstValue)) {
                            $reply = $firstValue;
                        } else {
                            $reply = json_encode($responseData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                        }
                    } elseif (!empty($responseData)) {
                        $reply = $responseData;
                    } else {
                        $reply = 'لم يتم استلام رد من الخادم. يرجى المحاولة مرة أخرى.';
                    }
                }
                
                return response()->json([
                    'response' => $reply,
                ]);
            } else {
                // Handle non-successful responses
                $statusCode = $response->status();
                $errorBody = $response->body();
                
                \Log::error('Chat webhook failed', [
                    'status' => $statusCode,
                    'body' => $errorBody,
                ]);
                
                // Try to extract error message from response
                $errorMessage = 'عذراً، حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.';
                if ($statusCode === 404) {
                    $errorMessage = 'عذراً، لم يتم العثور على الخادم. يرجى المحاولة لاحقاً.';
                } elseif ($statusCode === 500) {
                    $errorMessage = 'عذراً، حدث خطأ في الخادم. يرجى المحاولة لاحقاً.';
                } elseif ($statusCode === 503) {
                    $errorMessage = 'عذراً، الخادم غير متاح حالياً. يرجى المحاولة لاحقاً.';
                }
                
                return response()->json([
                    'response' => $errorMessage,
                ], 200); // Return 200 to avoid frontend error handling issues
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            \Log::error('Chat webhook connection error: ' . $e->getMessage());
            
            return response()->json([
                'response' => 'عذراً، تعذر الاتصال بالخادم. يرجى التحقق من الاتصال بالإنترنت والمحاولة مرة أخرى.',
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Chat validation error: ' . $e->getMessage());
            
            return response()->json([
                'response' => 'الرجاء إدخال رسالة صحيحة.',
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Chat webhook error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            return response()->json([
                'response' => 'عذراً، حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.',
            ], 200);
        }
    }
}
