## DSOMM Activity Dependencies

The activities in this DSOMM Model have the following dependencies.

```mermaid
graph LR

0(L2 Basic data leak prevention)
1(L2 AI usage policy)
2(L4 Automated data leak detection for AI interactions)
3(L4 Hallucination detection for AI responses)
4(L4 Secure output handling in AI applications)
5(L3 Input validation for AI systems)
6(L1 Context-aware output encoding)
7(L5 Protection of agent memory against poisoning)
8(L2 Instructed load of security rules)
9(L1 Static load of security rules)
10(L2 Spec-driven development)
11(L2 Inventory of AI agents)
12(L2 Language and framework specific security rules)
13(L1 Version control)
14(L2 Threat modeling rule)
15(L1 Conduction of simple threat modeling on technical level)
16(L3 Audit logging of AI agent actions)
17(L2 Centralized application logging)
18(L3 Decommissioning of AI agents)
19(L3 Least privilege on external systems for AI agents)
20(L3 Evaluation of the trust of used AI components)
21(L2 Evaluation of the trust of used components)
22(L3 Threat modeling of AI components)
23(L4 Anomaly detection for AI agent behavior)
24(L2 Alerting)
25(L4 Dynamic load of security rules)
26(L5 Automated containment of anomalous AI agents)
27(L2 Rate limiting and resource budgets for AI systems)
28(L2 Monitoring of costs)
29(L2 Untrusted workspace handling for AI agents)
30(L1 Usage of sandboxing for AI agents)
31(L2 Permission management for AI agents)
32(L3 Network isolation for AI agents)
33(L4 Human approval for irreversible AI agent actions)
34(L4 Trust boundaries between AI agents)
35(L4 Regular automated AI red teaming)
36(L3 Basic AI red teaming)
37(L2 Human review of AI generated plans)
38(L2 Human review of AI generated specifications)
39(L2 Self-verification of AI generated changes)
40(L1 Defined build process)
41(L2 Security unit tests for important components)
42(L2 Static and dynamic analysis of AI generated code)
43(L3 Static analysis for important server side components)
44(L2 Simple Scan)
45(L2 Validation of AI-suggested dependencies)
46(L2 Software Composition Analysis server side)
47(L3 Human review of AI generated code)
48(L3 No verification bypass for AI generated code)
49(L3 Security test generation with AI)
50(L4 Continuous detection of compromised AI components)
51(L3 Test for compromised components)
52(L5 Drift detection for agent instructions and guardrails)
53(L3 Drift detection for deployed configuration)
54(L2 Building and testing of artifacts in virtualized environments)
55(L2 Usage of containers)
56(L2 Pinning of artifacts)
57(L2 SBOM of components)
58(L3 Signing of code)
59(L5 Signing of artifacts)
60(L1 Automated deployment process)
61(L1 Defined deployment process)
62(L1 Inventory of production components)
63(L2 Inventory of production artifacts)
64(L3 Handover of confidential parameters)
65(L2 Environment depending configuration parameters secrets)
66(L3 Inventory of production dependencies)
67(L3 Rolling update on deployment)
68(L4 Canary deployment)
69(L4 Same artifact for environments)
70(L4 Usage of feature toggles)
71(L5 Blue/Green Deployment)
72(L4 Smoke Test)
73(L2 Automated merge of automated PRs)
74(L1 Automated PRs for patches)
75(L3 Automated deployment of automated PRs)
76(L3 Creation of simple abuse stories)
77(L3 Creation of threat modeling processes and standards)
78(L4 Conduction of advanced threat modeling)
79(L5 Creation of advanced abuse stories)
80(L2 Regular security training of security champions)
81(L2 Each team has a security champion)
82(L2 Determining the protection requirement)
83(L2 App. Hardening Level 1)
84(L1 App. Hardening Level 1 50%)
85(L3 App. Hardening Level 2 75%)
86(L4 App. Hardening Level 2)
87(L5 App. Hardening Level 3)
88(L3 Block force pushes)
89(L2 Require a PR before merging)
90(L3 Dismiss stale PR approvals)
91(L3 Require status checks to pass)
92(L2 Central identity provider for human access)
93(L1 Simple access control for systems)
94(L2 Least-privilege access baseline)
95(L2 Account inventory)
96(L2 MFA)
97(L1 MFA for admins)
98(L3 Automated authorization test coverage)
99(L1 Enforce server-side authorization on every request)
100(L3 Automated joiner-mover-leaver provisioning)
101(L3 Fine-Grained Access Controls for authentication and authorization)
102(L3 Use correct OAuth2/OIDC authorization flows)
103(L4 Just-in-time privileged access)
104(L4 Periodic access recertification)
105(L4 Segregation of duties for critical actions)
106(L4 Workload and machine identity)
107(L5 Continuous and risk-adaptive access)
108(L5 Externalized policy-as-code authorization)
109(L2 Backup)
110(L2 Usage of test and production environments)
111(L2 Virtual environments are limited)
112(L3 Immutable infrastructure)
113(L3 Infrastructure as Code)
114(L3 Limitation of system events)
115(L3 Audit of system events)
116(L3 Usage of security by default for components)
117(L3 WAF baseline)
118(L4 Production near environments are used by developers)
119(L4 WAF medium)
120(L5 WAF Advanced)
121(L3 Logging of AI interactions)
122(L3 Visualized logging)
123(L1 Centralized system logging)
124(L5 Correlation of security events)
125(L2 Visualized metrics)
126(L1 Simple application metrics)
127(L1 Simple system metrics)
128(L3 Advanced availability and stability metrics)
129(L3 Deactivation of unused metrics)
130(L3 Targeted alerting)
131(L4 Advanced app. metrics)
132(L4 Coverage and control metrics)
133(L4 Defense metrics)
134(L3 Filter outgoing traffic)
135(L4 Screens with metric visualization)
136(L3 Grouping of metrics)
137(L5 Metrics are combined with tests)
138(L2 Patching mean time to resolution via PR)
139(L3 Generation of response statistics)
140(L3 Usage of a vulnerability management system)
141(L4 Patching mean time to resolution via production)
142(L2 Artifact-based false positive treatment)
143(L1 Simple false positive treatment)
144(L3 Fix based on accessibility)
145(L1 Treatment of defects with high or critical severity)
146(L3 Global false positive treatment)
147(L2 Exploit likelihood estimation)
148(L3 Office Hours)
149(L2 Coverage of client side dynamic components)
150(L2 Usage of different roles)
151(L3 Coverage of hidden endpoints)
152(L3 Coverage of more input vectors)
153(L3 Coverage of sequential operations)
154(L4 Usage of multiple scanners)
155(L5 Coverage of service to service communication)
156(L2 Test for exposed services)
157(L2 Isolated networks for virtual environments)
158(L2 Test network segmentation)
159(L3 Test for unauthorized installation)
160(L2 Test for Time to Patch)
161(L2 Test libyear)
162(L3 API design validation)
163(L3 Software Composition Analysis client side)
164(L3 Static analysis for important client side components)
165(L3 Test for Patch Deployment Time)
166(L4 Static analysis for all self written components)
167(L4 Usage of multiple analyzers)
168(L5 Dead code elimination)
169(L5 Exclusion of source code duplicates)
170(L5 Static analysis for all components/libraries)
171(L4 Correlate known vulnerabilities in infrastructure with new image versions)
172(L2 Usage of a maximum lifetime for images)
173(L4 Test of infrastructure components for known vulnerabilities)


1 --> 0
1 --> 11
1 --> 20
0 --> 2
4 --> 3
5 --> 4
5 --> 7
6 --> 4
6 --> 117
9 --> 8
9 --> 12
9 --> 25
10 --> 8
10 --> 12
10 --> 14
10 --> 25
10 --> 37
10 --> 38
13 --> 10
13 --> 61
15 --> 14
15 --> 22
15 --> 76
15 --> 77
15 --> 78
11 --> 16
11 --> 18
17 --> 16
17 --> 121
17 --> 122
19 --> 18
19 --> 26
19 --> 34
19 --> 47
21 --> 20
21 --> 159
16 --> 23
16 --> 33
16 --> 34
24 --> 23
24 --> 27
24 --> 17
24 --> 124
24 --> 130
14 --> 25
14 --> 49
8 --> 25
23 --> 26
28 --> 27
30 --> 29
30 --> 32
31 --> 19
31 --> 33
36 --> 35
38 --> 37
40 --> 39
40 --> 48
40 --> 56
40 --> 57
40 --> 58
40 --> 59
40 --> 60
40 --> 61
40 --> 69
40 --> 116
40 --> 44
40 --> 46
40 --> 161
40 --> 163
40 --> 164
40 --> 43
40 --> 165
40 --> 51
40 --> 168
40 --> 169
41 --> 39
43 --> 42
43 --> 48
43 --> 166
43 --> 170
44 --> 42
44 --> 48
44 --> 150
44 --> 155
46 --> 45
46 --> 147
46 --> 51
46 --> 167
47 --> 49
20 --> 50
51 --> 50
7 --> 52
53 --> 52
55 --> 54
55 --> 111
56 --> 59
61 --> 60
61 --> 109
61 --> 110
60 --> 62
60 --> 63
60 --> 53
60 --> 67
60 --> 68
60 --> 118
60 --> 72
62 --> 63
62 --> 82
62 --> 144
62 --> 46
62 --> 162
62 --> 163
62 --> 164
62 --> 43
62 --> 166
62 --> 170
65 --> 64
63 --> 66
57 --> 66
69 --> 70
72 --> 71
74 --> 73
74 --> 138
74 --> 141
74 --> 160
74 --> 165
73 --> 75
77 --> 76
77 --> 78
76 --> 79
81 --> 80
81 --> 140
84 --> 83
83 --> 85
85 --> 86
86 --> 87
89 --> 88
89 --> 90
89 --> 91
93 --> 92
93 --> 94
95 --> 94
97 --> 96
97 --> 103
97 --> 96
99 --> 98
94 --> 100
94 --> 101
94 --> 103
94 --> 104
94 --> 105
94 --> 106
92 --> 100
92 --> 102
100 --> 104
103 --> 107
101 --> 107
101 --> 108
104 --> 107
113 --> 112
113 --> 118
115 --> 114
117 --> 119
117 --> 120
123 --> 122
122 --> 124
125 --> 24
125 --> 128
125 --> 115
125 --> 129
125 --> 131
125 --> 132
125 --> 133
126 --> 28
126 --> 125
126 --> 128
126 --> 131
127 --> 28
127 --> 125
134 --> 133
136 --> 135
136 --> 137
140 --> 139
140 --> 146
138 --> 141
143 --> 142
145 --> 144
142 --> 146
147 --> 140
147 --> 163
148 --> 140
150 --> 149
150 --> 151
150 --> 152
150 --> 153
150 --> 154
157 --> 156
157 --> 158
164 --> 166
164 --> 170
163 --> 167
166 --> 167
172 --> 171
172 --> 173

O --> 1
O --> 5
O --> 6
O --> 9
O --> 13
O --> 15
O --> 21
O --> 30
O --> 31
O --> 36
O --> 40
O --> 41
O --> 55
O --> 65
O --> 74
O --> 81
O --> 84
O --> 89
O --> 93
O --> 95
O --> 97
O --> 99
O --> 113
O --> 123
O --> 126
O --> 127
O --> 134
O --> 136
O --> 143
O --> 145
O --> 148
O --> 157
O --> 172
```
